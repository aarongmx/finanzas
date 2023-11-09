<div class="grid" style="--bs-gap: 1rem;">
    <div class="g-col-12 g-col-md-4 g-start-md-5">
        <div class="card">
            <div class="card-body">
                <img src="{{asset('img/logo.svg')}}" alt="Logo Oficial ML Grupo Comercial" width="186">
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
