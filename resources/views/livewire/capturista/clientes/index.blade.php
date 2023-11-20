<div class="container-fluid p-4">
    <x-modal id="nuevo-cliente-modal">
        <livewire:administrador.clientes.form/>
    </x-modal>
    <div class="row mb-3">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <h1 class="h3">Clientes</h1>
            <button class="btn btn-primary" data-bs-target="#nuevo-cliente-modal" data-bs-toggle="modal">Nuevo cliente</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <livewire:clientes-sucursal-table/>
        </div>
    </div>
</div>
