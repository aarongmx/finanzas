<div class="container-fluid p-4">
    <x-modal id="producto-form" wire:ignore.self title="Producto">
        <livewire:administrador.productos.form/>
    </x-modal>
    <div class="row mb-3">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <h1 class="h3">Productos</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#producto-form">
               Nuevo producto
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <livewire:productos-table/>
        </div>
    </div>
</div>

