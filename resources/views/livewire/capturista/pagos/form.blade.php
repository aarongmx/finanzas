<form wire:submit.prevent="store">
    <x-form.input
        label="Monto"
        wire:model="form.monto"
    />

    <x-form.input
        type="date"
        wire:model="form.fecha"
        label="Fecha de pago"
    />

    <x-button type="submit">Abonar</x-button>
</form>
