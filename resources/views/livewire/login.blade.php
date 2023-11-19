<div class="grid min-vh-100" style="--bs-gap: 1rem; background: url({{asset('img/background.jpg')}}) no-repeat center / cover;">
    <div class="g-col-12 g-col-md-4 g-start-md-5">
        <div class="card">
            <div class="card-header border-0 text-center">
                <img src="{{asset('img/logo.svg')}}" alt="Logo Oficial ML Grupo Comercial" width="186">
            </div>
            <div class="card-body">
                <form wire:submit.prevent="login">
                    <x-form.input
                        id="correo"
                        type="email"
                        label="Correo"
                        wire:model="form.email"
                    />
                    <x-form.input
                        id="password"
                        type="password"
                        label="Contraseña"
                        wire:model="form.password"
                    />
                    <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                </form>
            </div>
        </div>
    </div>
</div>
