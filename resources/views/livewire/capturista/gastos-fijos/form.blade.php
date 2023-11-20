<form wire:submit.prevent="store">
    <x-form.input
        wire:model="form.concepto"
        label="Concepto"
    />

    <x-form.input
        wire:model="form.precio"
        step="0.01"
        type="number"
        label="Precio"
    />

    <x-button type="submit">Registrar</x-button>
</form>
