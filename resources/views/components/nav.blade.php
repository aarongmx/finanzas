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
                    <x-nav-item path="administracion.home">Inicio</x-nav-item>
                    <x-nav-item path="administracion.sucursales.index">Sucursales</x-nav-item>
                    <x-nav-item path="administracion.cuentas.index">Cuentas</x-nav-item>
                    <x-nav-item path="administracion.cuentas.form">Registrar cuenta</x-nav-item>
                    <x-nav-item path="administracion.productos.index">Productos</x-nav-item>
                    <x-nav-item path="administracion.clientes.index">Clientes</x-nav-item>
                    <x-nav-item path="administracion.creditos.index">Créditos</x-nav-item>
                    <x-nav-item path="administracion.usuarios.index">Usuarios</x-nav-item>
                @endif
                @if(auth()->user()->hasRole(\App\Enums\Role::CAPTURISTA))
                    <x-nav-item path="capturista.home">Inicio</x-nav-item>
                    <x-nav-item path="capturista.cuenta.sucursal">Cuenta</x-nav-item>
                    <x-nav-item path="capturista.salidas.index">Salidas</x-nav-item>
                    <x-nav-item path="capturista.entradas.index">Entradas</x-nav-item>
                    <x-nav-item path="capturista.clientes.index">Clientes</x-nav-item>
                    <x-nav-item path="capturista.creditos.índex">Créditos</x-nav-item>
                @endif
            </ul>
            <ul class="navbar-nav flex-row flex-wrap ms-md-auto">
                <li class="nav-item col-6 col-lg-auto text-white px-4 justify-content-center align-items-center">
                    <p class="m-0">
                        {{auth()->user()->name}} - {{auth()->user()?->sucursal?->nombre ?? 'ADMINISTRACIÓN'}}
                    </p>
                </li>
                <li class="nav-item col-6 col-lg-auto">
                    <form action='/logout' method='POST'>
                        @csrf
                        <button type="submit" class="btn btn-light">Cerrar sesión</button>
                    </form>
                </li>
            </ul>

        </div>
    </div>
</nav>
