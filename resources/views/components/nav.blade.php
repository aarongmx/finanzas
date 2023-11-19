<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            <img src="{{asset('img/logo-white.svg')}}" alt="Logotipo ML Grupo Comercial" width="86">
        </a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if(auth()->user()->hasRole(\App\Enums\Role::ADMINISTRACION))
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('administracion.sucursales.index')) active @endif"
                           href="{{route('administracion.sucursales.index')}}">Sucursales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('administracion.cuentas.index')) active @endif"
                           href="{{route('administracion.cuentas.index')}}">Cuentas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('administracion.cuentas.form')) active @endif"
                           href="{{route('administracion.cuentas.form')}}">Registrar cuenta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('administracion.productos.index')) active @endif"
                           href="{{route('administracion.productos.index')}}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('administracion.clientes.index')) active @endif"
                           href="{{route('administracion.clientes.index')}}">Clientes</a>
                    </li>
                @endif
                @if(auth()->user()->hasRole(\App\Enums\Role::CAPTURISTA))
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('capturista.home')) active @endif"
                           href="{{route('capturista.home')}}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('capturista.cuenta.sucursal')) active @endif"
                           href="{{route('capturista.cuenta.sucursal')}}">Cuenta</a>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav flex-row flex-wrap ms-md-auto">
                <li class="nav-item col-6 col-lg-auto text-white">{{auth()->user()->name}}</li>
                <li class="nav-item col-6 col-lg-auto">
                    <form action='/logout' method='POST'>
                        @csrf
                        <button type="submit" class="dropdown-item">Cerrar sesión</button>
                    </form>
                </li>
            </ul>

        </div>
    </div>
</nav>
