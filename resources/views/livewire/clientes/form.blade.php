<form wire:submit="save">
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

    <div class="row">
        <div class="col-md-3">
            <x-form.input
                id="direccion-calle"
                label="Calle"
                wire:model="form.calle"
            />
        </div>
        <div class="col-md-1">
            <x-form.input
                id="direccion-numero-exterior"
                label="Número exterior"
                wire:model="form.numeroExterior"
            />
        </div>
        <div class="col-md-2">
            <x-form.input
                id="direccion-numero-interior"
                label="Número interior"
                wire:model="form.numeroInterior"
            />
        </div>
        <div class="col-md-3">
            <x-form.input
                id="direccion-colonia"
                label="Colonia"
                wire:model="form.colonia"
            />
        </div>
        <div class="col-md-2">
            <x-form.input
                id="direccion-estado"
                label="Estado"
                wire:model="form.estado"
            />
        </div>
        <div class="col-md-1">
            <x-form.input
                id="direccion-codigo-postal"
                label="Código postal"
                wire:model="form.codigoPostal"
            />
        </div>
    </div>


    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
