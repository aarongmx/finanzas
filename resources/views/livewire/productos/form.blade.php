<form wire:submit.prevent="store">
    <x-form.input
        label="Nombre"
        id="nombre"
        wire:model="form.nombre"
    />
    <div class="mb-3">
        <label for="categoria-select">Categoría</label>
        <select id="categoria-select" class="form-select" wire:model="form.categoria_id">
            <option value="" selected>-- Seleccione una categoria --</option>
            @forelse($this->categorias as $categoria)
                <option value="{{$categoria->id}}" wire:key="{{$categoria->id}}">{{$categoria->nombre}}</option>
            @empty
            @endforelse
        </select>
    </div>
    <button class="btn btn-primary" type="submit">Guardar</button>
</form>
