<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Cuenta</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @forelse($this->categorias as $categoria)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="{{$categoria->nombre}}"
                           id="categoria-{{$categoria->id}}" value="{{$categoria->id}}"
                           wire:model.live="categoriaSeleccionada">
                    <label class="form-check-label" for="categoria-{{$categoria->id}}">{{$categoria->nombre}}</label>
                </div>
            @empty
            @endforelse
        </div>
    </div>

    @forelse($this->items[$categoriaSeleccionada] ?? [] as $items)
        @forelse($items ?? [] as $id => $item)
            <div class="row row-cols-10" wire:key="{{$id}}">
                <div class="col">
                    <p>{{$item['producto']}}</p>
                </div>

                <div class="col">
                    <x-form.input
                        label="Precio"
                        wire:model="form.items.{{$id}}.precio"
                    />
                </div>

                <div class="col">
                    <x-form.input
                        label="Kilos existencia"
                        wire:model="form.items.{{$id}}.kilos_existencia"
                    />
                </div>

                <div class="col">
                    <x-form.input
                        label="Importe existencia"
                        wire:model="form.items.{{$id}}.importe_existencia"
                    />
                </div>

                <div class="col">
                    <x-form.input
                        label="Kilos entrada"
                        wire:model="form.items.{{$id}}.kilos_entrada"
                    />
                </div>

                <div class="col">
                    <x-form.input
                        label="Importe entrada"
                        wire:model="form.items.{{$id}}.importe_entrada"
                    />
                </div>

                <div class="col">
                    <x-form.input
                        label="Kilos Salida"
                        wire:model="form.items.{{$id}}.kilos_salida"
                    />
                </div>

                <div class="col">
                    <x-form.input
                        label="Importe Salida"
                        wire:model="form.items.{{$id}}.importe_salida"
                    />
                </div>

                <div class="col">
                    <x-form.input
                        label="Kilos Sobrante"
                        wire:model="form.items.{{$id}}.kilos_sobrante"
                    />
                </div>

                <div class="col">
                    <x-form.input
                        label="Importe Sobrante"
                        wire:model="form.items.{{$id}}.importe_sobrante"
                    />
                </div>
            </div>
        @empty
        @endforelse
    @empty
    @endforelse
</div>
