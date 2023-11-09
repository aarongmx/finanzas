<form wire:submit.prevent="store">
    <x-form.input wire:model="form.nombre" label="Nombre"/>
    <x-form.input wire:model="form.codigo_postal" label="Código postal"/>
    <x-form.input wire:model="form.colonia" label="Colonia"/>
    <x-form.input wire:model="form.estado" label="Estado"/>
    <x-form.input wire:model="form.numero_interior" label="Número interior"/>
    <x-form.input wire:model="form.numero_exterior" label="Número exterior"/>
    <x-form.input wire:model="form.calle" label="Calle"/>
    <button class="btn btn-primary" type="submit">Guardar</button>
</form>
