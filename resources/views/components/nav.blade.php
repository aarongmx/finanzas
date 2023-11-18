<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            <img src="{{asset('img/logo-white.svg')}}" alt="Logotipo ML Grupo Comercial" width="86">
        </a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
               {{-- <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('sucursales.index')) active @endif" href="{{route('sucursales.index')}}">Sucursales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('cuentas.index')) active @endif" href="{{route('cuentas.index')}}">Cuentas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('cuentas.form')) active @endif" href="{{route('cuentas.form')}}">Registrar cuenta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('productos.index')) active @endif" href="{{route('productos.index')}}">Productos</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @if(request()->routeIs('clientes.*')) active @endif" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Clientes
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('clientes.index')}}">Todos</a></li>
                        <li><a class="dropdown-item" href="{{route('clientes.form')}}">Todos</a></li>
                    </ul>
                </li>--}}
            </ul>
            <ul class="navbar-nav flex-row flex-wrap ms-md-auto">
                <li class="nav-item">{{auth()->user()->name}}</li>
            </ul>

            <form action='/logout' method='POST'>
                @csrf
                <button type="submit" class="dropdown-item">Cerrar sesión</button>
            </form>
        </div>
    </div>
</nav>
