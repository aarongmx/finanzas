<form wire:submit="save">

    @if(auth()->user()->hasRole(\App\Enums\Role::ADMINISTRACION))
        <x-form.select wire:model="form.sucursalId" label="Sucursal">
            @forelse($this->sucursales as $sucursal)
                <option value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
            @empty
            @endforelse
        </x-form.select>
    @endif

    <x-form.input
        id="cliente-rfc"
        label="RFC"
        wire:model="form.rfc"
    />

    <x-form.input
        id="cliente-razon-social"
        label="Razón social"
        wire:model="form.razonSocial"
    />

    <x-form.input
        id="cliente-nombre-comercial"
        label="Nombre comercial"
        wire:model="form.nombreComercial"
    />

    <x-form.input
        id="direccion-calle"
        label="Calle"
        wire:model="form.calle"
    />
    <div class="row">
        <div class="col-md-6">
            <x-form.input
                id="direccion-numero-exterior"
                label="Número exterior"
                wire:model="form.numeroExterior"
            />
        </div>
        <div class="col-md-6">
            <x-form.input
                id="direccion-numero-interior"
                label="Número interior"
                wire:model="form.numeroInterior"
            />
        </div>
    </div>
    <x-form.input
        id="direccion-colonia"
        label="Colonia"
        wire:model="form.colonia"
    />
    <x-form.input
        id="direccion-estado"
        label="Estado"
        wire:model="form.estado"
    />

    <x-form.input
        id="direccion-codigo-postal"
        label="Código postal"
        wire:model="form.codigoPostal"
    />



    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
