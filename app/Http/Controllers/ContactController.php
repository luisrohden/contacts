<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Contact;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $contacts = Contact::where('user_id','=',Auth::id())->get();
        return view('contacts.list',['contacts' => $contacts]);
    }
    public function register(request $request){
        return view('contacts.register');
    }
    public function registerAction(request $request){
        /*Validanting Example :: start*/
        $validatingRules = [
            'name' => 'required|string|max:255',
            'note' => 'string|max:255',
        ];
        $data = $request->only('name','note');

        $validator = Validator::make($data,$validatingRules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator->errors()->first(),
            ]);
        }
        /*Validanting Example :: end*/
        extract($request->only('name','note','phone','address'));

        $contact = new Contact();
        $contact->name = $name;
        $contact->user_id = Auth::id();
        if(isset($note)){
            $contact->note = $note;
        }else{
            $contact->note = '';
        }
        $contact->save();
        //Phone
        $phoneCount = count($phone['number']);
        $phoneList = [];
        for($i = 0; $i < $phoneCount; $i++){
            if($phone['number'][$i] == '') continue;
            $phoneList[] = [
                'number' => $phone['number'][$i],
                'type' => $phone['type'][$i],
                'contact_id' => $contact->id
            ];

        }
        if(count($phoneList)){
            Phone::insert($phoneList);
        }
        //Address
        $addressCount = count($address);
        $addressList = [];
        for($i = 0; $i < $addressCount; $i++){
            if($address[$i] == '') continue;
            $addressList[] = [
                'address' => $address[$i],
                'contact_id' => $contact->id
            ];

        }
        if(count($addressList)){
            Address::insert($addressList);
        }
        Session::flash('message', 'Contato registrado com sucesso!');
        Session::flash('alert-class', 'alert-success');
        return redirect('/');
    }
    public function edit(Request $request) {
        $contact_id = $request->contact_id * 1;//clear
        $contact = Contact::find($contact_id);
        if(!isset($contact) || $contact->user_id != Auth::id()){
            Session::flash('message', 'Contato não localizado!');
            Session::flash('alert-class', 'alert-danger');
            return view('contacts.notfound');
        }
        //Phones
        $phones = Phone::where('contact_id','=',$contact_id)->get();
        //Adresses
        $addresses = Address::where('contact_id','=',$contact_id)->get();
        $data = [
            'name' => $contact->name,
            'note' => $contact->note,
            'phones' => $phones,
            'addresses' => $addresses,
            'contact_id' => $contact_id,
        ];
        return view('contacts.edit',$data);
    }
    public function editAction(Request $request){
        $contact_id = $request->contact_id * 1;//clear
        $contact = Contact::find($contact_id);
        if(!isset($contact) || $contact->user_id != Auth::id()){
            Session::flash('message', 'Contato não localizado!');
            Session::flash('alert-class', 'alert-danger');
            return view('contacts.notfound');
        }
        $data = $request->only('name','note');
        $contact->name = $data['name'];
        $contact->note = isset($data['note']) ? $data['note'] : '';
        $contact->save();

        //Phones

        $phones = [
            'saved' => Phone::where('contact_id','=',$contact_id)->get(),
            'edited' => $request->only('phone')['phone'],
        ];
        $this->editPhones($phones,$contact_id);

        //Adresses
        $addresses = [
            'saved' => Address::where('contact_id','=',$contact_id)->get(),
            'edited' => $request->only('address')['address'],
        ];
        $this->editAdresses($addresses,$contact_id);
        Session::flash('message', 'Contato <strong>' . $data['name'] . '</strong> editado com sucesso!');
        Session::flash('alert-class', 'alert-success');
        return redirect('/');
    }
    public function editAdresses($addresses,$contact_id):void
    {
        if(count($addresses['saved']) > count($addresses['edited'])){
            $limit = count($addresses['edited']);
            $diff = $addresses['saved'] - $addresses['edited'];
            $add = false;
        }
        else{
            $limit = count($addresses['edited']);
            $diff = count($addresses['edited']) - count($addresses['saved']);
            $add = true;
        }

        for($i = 0; $i < $limit; $i++){
            $selected = Address::find($addresses['saved'][$i]['id']);
            $selected->address =  $addresses['edited'][$i];
            $selected->save();
        }
        if($diff){
            $limit+=$diff;
            for($i = $diff; $i < $limit;$i++){
                if($add){
                    $address = new Address();
                    $address->number = $addresses['edited']['address'][$i];
                    $address->save();
                }else{
                    Phone::where('id','=',$addresses['saved'][$i]['id'])->delete();
                }
            }
        }
    }
    public function editPhones($phones,$contact_id) :void
    {
        if(count($phones['saved']) > count($phones['edited'])){
            $limit = count($phones['edited']);
            $diff = $phones['saved'] - $phones['edited'];
            $add = false;
        }
        else{
            $limit = count($phones['saved']);
            $diff = count($phones['edited']) - count($phones['saved']);
            $add = true;
        }
        //dd($phones);
        for($i = 0; $i < $limit; $i++){
            $selected = Phone::find($phones['saved'][$i]['id']);
            $selected->number =  $phones['edited']['number'][$i];
            $selected->type = $phones['edited']['number'][$i];
            $selected->save();
        }
        if($diff){
            $limit+=$diff;
            //dd($phones['edited']);
            for($i = $diff; $i < $limit;$i++){
                if($add){

                    if($phones['edited']['number'][$i] == '' || $phones['edited']['type'][$i] == '' || $phones['edited']['number'][$i] == NULL){
                        continue;
                    }
                    $phone = new Phone();

                    $phone->number = $phones['edited']['number'][$i];
                    $phone->type = $phones['edited']['type'][$i];
                    $phone->contact_id = $contact_id;
                    $phone->save();
                }else{
                    Phone::where('id','=',$phones['saved'][$i]['id'])->delete();
                }
            }
        }
    }
    public function delete(Request $request) :object
    {
        $contact = Contact::find($request->contact_id);
        $data = [
            'contact_id' => $contact->id,
            'name' => $contact->name
        ];
        return view('contacts.delete',$data);
    }
    public function deleteAction(Request $request) :object
    {
        $contact = Contact::find($request->contact_id);
        $name = $contact->name;
        $contact->delete();
        Session::flash('message', 'Contato <strong>' . $name . '</strong> excluído com sucesso!');
        Session::flash('alert-class', 'alert-success');
        return redirect('/');

    }
}
