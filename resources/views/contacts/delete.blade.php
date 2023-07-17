<form method="post">
    {{ csrf_field() }}
    <div class="highlight">
        Tem certeza que você deseja deletar o contato <strong>{{$name}}</strong>
    </div>
    @component('components.form.area')
        @slot('class','actions')
        @component('components.form.button')
            @slot('type','submit')
            @slot('value','Excluir Contato')
        @endcomponent
        @component('components.form.link')
            @slot('type','cancel')
            @slot('class','toRight')
            @slot('value','Cancelar')
            @slot('href','/')
        @endcomponent
    @endcomponent
</form>
