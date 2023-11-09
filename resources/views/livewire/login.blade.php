<div class="container">
    <div class="row">
        <div class="col-md-5">
            <img src="{{asset('img/logo.svg')}}" alt="Logo Oficial ML Grupo Comercial">
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
                <button type="submit" class="btn btn-primary">Iniciar sesión</button>
            </form>
        </div>
        <div class="col-md-7">

        </div>
    </div>
</div>
