<div class="container">
    <div class="row">
        <div class="col-12">
            <form wire:submit.prevent="store">
                <x-form.input
                    label="Fecha de venta"
                    type="date"
                />
                <x-form.select>
                    <option></option>
                </x-form.select>
                <x-form.input
                    label="Cantida"
                />
                <x-form.input
                    label="Precio"
                />
                <x-button type="submit">Guardar</x-button>
            </form>
        </div>
    </div>
</div>
