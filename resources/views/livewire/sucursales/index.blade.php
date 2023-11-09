<div class="container py-4">
    <x-modal id="sucursal">
        <livewire:sucursales.form/>
    </x-modal>
    <div class="row mb-3">
        <div class="col-12">
            <h1>Sucursales</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sucursal">
                Launch demo modal
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <livewire:sucursal-table/>
        </div>
    </div>
</div>
