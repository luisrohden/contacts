@extends('layouts.app')

@section('title', 'Listar contatos')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">
        @if(isset($contacts) && count($contacts))
            <div class="contactList">
                @component('components.message')
                @endcomponent
                <div class="contactList_names">
                    <ul>
                    @foreach($contacts as $contact)
                        <li data-id="{{$contact->id}}" class="contactList_name">
                            <a href="/contatos/editar/{{$contact->id}}">{{$contact->name}}</a>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        @else
            <div class="highlight">
                Nenhum contato cadastrado
            </div>
        @endif
    </div>

@endsection






