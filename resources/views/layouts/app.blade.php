<html>
    <head>
        <title>Contatos - @yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/style.min.css">
        <script src="/js/app.js"></script>

    </head>
    <body>
        @section('sidebar')
            <header class="header">

                <div class="container">
                    <h1>Contatos</h1>
                    <h2>@yield('title')</h2>
                    <nav>
                        <ul>
                            <li>
                                <a href="/">Listar Contatos</a>
                            </li>
                            <li>
                                <a href="/contatos/cadastrar">Cadastrar Contato</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </header>
        @show
        @yield('content')
        <footer class="footer">
            <div class="container">
                Luis Rohden&reg;
            </div>
        </footer>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</html>
