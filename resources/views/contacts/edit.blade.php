@extends('layouts.app')

@section('title', 'Editar contato')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">
        <form method="post" class="form">
            {{ csrf_field() }}
            @component('components.message')
            @endcomponent
            @component('components.form.input')
                @slot('type','text')
                @slot('label','Nome')
                @slot('name','name')
                @slot('required',true)
                @slot('placeholder','Nome do contato')

                @slot('value',$name)

            @endcomponent
            @component('components.form.repeater')
                @slot('label','Adicionar telefone')
                @slot('more')
                    @if(count($phones) > 1)
                        @for($i = 1; $i<count($phones) ; $i++)
                            @component('components.form.reaper-content')
                                @component('components.form.select')
                                    @slot('label','Tipo')
                                    @slot('name','phone[type][]')
                                    @slot('Options',['c'=>'Celular','f'=>'Fixo'])
                                    @slot('value',$phones[$i]['type'])
                                @endcomponent
                                @component('components.form.input')
                                    @slot('type','text')
                                    @slot('label','Telefone')
                                    @slot('name','phone[number][]')
                                    @slot('placeholder','Nome do contato')
                                    @slot('value',$phones[$i]['number'])
                                @endcomponent
                            @endcomponent
                        @endfor
                    @endif
                @endslot
                @component('components.form.select')
                    @slot('label','Tipo')
                    @slot('name','phone[type][]')
                    @slot('Options',['c'=>'Celular','f'=>'Fixo'])
                    @slot('value',$phones[0]['type'])
                @endcomponent
                @component('components.form.input')
                    @slot('type','text')
                    @slot('label','Telefone')
                    @slot('name','phone[number][]')
                    @slot('placeholder','Nome do contato')
                    @slot('value',$phones[0]['number'])
                @endcomponent
            @endcomponent
            @component('components.form.repeater')
                @slot('label','Adicionar Endereço')
                @slot('more')
                    @if(count($addresses) > 1)
                        @for($i = 1; $i<count($addresses) ; $i++)
                            @component('components.form.reaper-content')
                                @component('components.form.textarea')
                                    @slot('label','Endereço')
                                    @slot('name','address[]')
                                    @slot('placeholder','Endereço sobre o contato')
                                    @slot('value',$addresses[$i]['address'])
                                @endcomponent
                            @endcomponent
                        @endfor
                    @endif
                @endslot
                @component('components.form.textarea')
                    @slot('label','Endereço')
                    @slot('name','address[]')
                    @slot('placeholder','Endereço sobre o contato')
                    @slot('value',$addresses[0]['address'])
                @endcomponent
            @endcomponent
            @component('components.form.textarea')
                @slot('label','Anotações')
                @slot('name','note')
                @slot('required',false)
                @slot('placeholder','Observações sobre o contato')

                @slot('value',$note)
            @endcomponent
            @component('components.form.area')
                @slot('class','actions')
                @component('components.form.button')
                    @slot('type','submit')
                    @slot('value','Salvar alterações do Contato')
                @endcomponent
                @component('components.form.button')
                    @slot('type','reset')
                    @slot('value','Limpar')
                @endcomponent
                @component('components.form.link')
                    @slot('type','delete')
                    @slot('class','toRight')
                    @slot('value','Excluir')
                    @slot('href','/contatos/excluir/'.$contact_id)
                @endcomponent
            @endcomponent
        </form>
    </div>
@endsection
