<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except' => [
                'register',
                'registerAction',
                'login',
                'loginAction',
            ]
            ]);
    }
    public function login(): string{
        return view('users.login');
    }
    public function loginAction(Request $request){
        $data = $request->only([
            'email',
            'password'
        ]);
        extract($data);
        $logged = $this->Auth($email,$password);
        if($logged){
            return redirect('/');
        }else{
            Session::flash('message', 'Email e senha não conferem!');
            Session::flash('alert-class', 'alert-danger');
            return redirect('login');
        }

    }
    public function logout(){
        Auth::logout();
        return redirect('login');
    }
    public function register(){

        return view('users.register');

    }
    public function registerAction(Request $request): string{
        $data = $request->only([
            'name',
            'email',
            'password'
        ]);
        if($this->UserExists($data['email'])){
            Session::flash('message', 'Email já cadastrado!');
            Session::flash('alert-class', 'alert-danger');
            return redirect('register');
        }
        $data['password'] = Hash::make($data['password']);
        $user = new User($data);
        $user->save();
        //
        extract($data);
        $logged = $this->Auth($email,$password);
        if($logged){
            return redirect('home');
        }else{
            return redirect('login');
        }


    }
    private function Auth(string $email, string $password){
        Auth::attempt([
            'email' => $email,
            'password' =>$password,
        ]);
        $user = Auth::getUser();
        if(Auth::id()){
            return true;
        }
        return false;

    }
    private function UserExists(string $email): bool{
        $userExist = User::where('email','=',$email)->get();

        if(count($userExist)) {
            return true;
        }

        return false;
    }
}
