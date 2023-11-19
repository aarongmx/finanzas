<div class="container-fluid p-4">
    <x-modal id="sucursal">
        <livewire:sucursales.form/>
    </x-modal>
    <div class="row mb-3">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <h1 class="h3">Sucursales</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sucursal">
                Nueva sucursal
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <livewire:sucursal-table/>
        </div>
    </div>
</div>
