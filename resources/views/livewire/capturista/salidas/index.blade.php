<div class="container-fluid p-4">
    <x-modal id="salida-modal">
        <livewire:capturista.salidas.form/>
    </x-modal>
    <div class="row mb-3">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <h1 class="h3">Salidas</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#salida-modal">Registrar salida</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <livewire:salidas-table/>
        </div>
    </div>
</div>
