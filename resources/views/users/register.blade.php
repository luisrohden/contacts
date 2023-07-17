<div class="container">
    <form method="post">
        {{ csrf_field() }}
        @component('components.message')
        @endcomponent

        @component('components.form.input')
            @slot('type','text')
            @slot('label','Nome')
            @slot('name','name')
            @slot('required',true)
            @slot('placeholder','Insira seu nome')
        @endcomponent
        @component('components.form.input')
            @slot('type','email')
            @slot('label','E-mail')
            @slot('name','email')
            @slot('required',true)
            @slot('placeholder','Insira seu email')
        @endcomponent
        @component('components.form.input')
            @slot('type','password')
            @slot('label','Senha')
            @slot('name','password')
            @slot('required',true)
            @slot('placeholder','Insira seu password')
        @endcomponent
        @component('components.form.area')
            @slot('class','actions')
            @component('components.form.button')
                @slot('type','submit')
                @slot('value','Registrar')
            @endcomponent
            @component('components.form.button')
                @slot('type','reset')
                @slot('value','Limpar')
            @endcomponent
        @endcomponent
    </form>
    <a href="/login">Login</a>
</div>
