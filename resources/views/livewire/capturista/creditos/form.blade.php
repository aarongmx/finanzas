<form wire:submit.prevent="store">
    <x-form.select label="Cliente" wire:model="form.clienteId">
        @forelse($this->clientes as $cliente)
            <option value="{{$cliente->id}}">{{$cliente->razon_social}}</option>
        @empty
        @endforelse
    </x-form.select>

    <x-form.input
        wire:model="form.fechaCredito"
        type="date"
        label="Fecha de registro"
    />

    <x-form.input
        wire:model="form.monto"
        type="number"
        step="0.01"
        label="Monto"
    />

    <x-button type="submit">Registrar</x-button>
</form>
