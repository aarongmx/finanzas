<div class="grid min-vh-100 align-items-center"
     style="--bs-gap: 1rem; background: url({{asset('img/background.jpg')}}) no-repeat center / cover;">
    <div class="g-col-12 g-col-md-4 g-start-md-5">
        <div class="card border-0">
            <div class="card-header border-0 text-center py-4">
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

                    <x-form.check label="Mantener sesión abierta" wire:model="form.remember"/>

                    <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                </form>
            </div>
        </div>
    </div>
</div>
