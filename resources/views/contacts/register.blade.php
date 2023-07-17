@extends('layouts.app')

@section('title', 'Registrar contato')

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
            @endcomponent
            @component('components.form.repeater')
                @slot('label','Adicionar telefone')
                @component('components.form.select')
                    @slot('label','Tipo')
                    @slot('name','phone[type][]')
                    @slot('Options',['c'=>'Celular','f'=>'Fixo'])
                @endcomponent
                @component('components.form.input')
                    @slot('type','text')
                    @slot('label','Telefone')
                    @slot('name','phone[number][]')
                    @slot('placeholder','Nome do contato')
                @endcomponent
            @endcomponent
            @component('components.form.repeater')
                @slot('label','Adicionar Endereço')
                @component('components.form.textarea')
                    @slot('label','Endereço')
                    @slot('name','address[]')
                    @slot('placeholder','Endereço sobre o contato')
                @endcomponent
            @endcomponent
            @component('components.form.textarea')
                @slot('label','Anotações')
                @slot('name','note')
                @slot('required',false)
                @slot('placeholder','Observações sobre o contato')
            @endcomponent
            @component('components.form.area')
                @slot('class','actions')
                @component('components.form.button')
                    @slot('type','submit')
                    @slot('value','Registrar Contato')
                @endcomponent
                @component('components.form.button')
                    @slot('type','reset')
                    @slot('value','Limpar')
                @endcomponent
            @endcomponent
        </form>
    </div>
@endsection
