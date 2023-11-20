<form wire:submit.prevent="store">
    <x-form.input
        label="Nombre"
        wire:model="form.name"
    />

    <x-form.input
        label="Correo"
        wire:model="form.email"
    />

    <x-form.select label="Sucursal" wire:model="form.sucursalId">
        @forelse($this->sucursales as $sucural)
            <option value="{{$sucural->id}}">{{$sucural->nombre}}</option>
        @empty
        @endforelse
    </x-form.select>

    <x-button type="submit">Registrar usuario</x-button>
</form>
