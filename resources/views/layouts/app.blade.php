<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cadastro de Produtos')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="{{asset("css/style.css")}}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <nav class="mt-3 ms-4">
        <a href="{{ url('/clientes') }}" class="link-menu {{request()->routeIs('clientes.*') ? 'link-ativo' : ''}}"><i class="bi bi-person-vcard-fill"></i> Cliente | </a>       
        <a href="{{ url('/produtos') }}" class="link-menu {{request()->routeIs('produtos.*') ? 'link-ativo' : ''}}"><i class="bi bi-archive-fill"></i> Produtos | </a>
        <a href="{{ url('/estoque') }}" class="link-menu {{request()->routeIs('estoque.*') ? 'link-ativo' : ''}}"> <i class="bi bi-box-fill"></i> Estoque | </a>
        <a href="{{ url('/carrinho') }}" class="link-menu {{request()->routeIs('carrinho.*') ? 'link-ativo' : ''}}"><i class="bi bi-cart-fill"></i> Carrinho | </a>
        <a href="{{ url('/pedidos') }}" class="link-menu {{request()->routeIs('pedidos.*') ? 'link-ativo' : ''}}"><i class="bi bi-clipboard-data-fill"></i> Pedidos | </a>
        <a href="{{ url('/cupons') }}" class="link-menu {{request()->routeIs('cupons.*') ? 'link-ativo' : ''}}"><i class="bi bi-postcard-heart"></i> Cupons | </a>
        <a href="{{ url('/variacoes') }}" class="link-menu {{request()->routeIs('variacoes.*') ? 'link-ativo' : ''}}"><i class="bi bi-plus-slash-minus"></i> Variações</a>
    </nav>
    <main class="container-fluid d-flex justify-content-center align-items-center ">
        <div class="main-section">
            @yield('content')
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    @yield('scripts')
</body>
</html>