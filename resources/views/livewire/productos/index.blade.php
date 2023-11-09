<div class="container">
    <x-modal id="exampleModal" wire:ignore.self>
        <livewire:productos.form/>
    </x-modal>
    <div class="row">
        <div class="col-12">
            <h1>Productos</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Launch demo modal
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <livewire:productos-table/>
        </div>
    </div>
</div>

