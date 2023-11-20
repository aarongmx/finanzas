<div class="container-fluid p-4">
    <x-modal id="gasto-modal" title="Gasto">
        <livewire:capturista.gastos-fijos.form/>
    </x-modal>

    <div class="row mb-3">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <h1 class="h3">Gastos fijos</h1>
            <x-button data-bs-toggle="modal" data-bs-target="#gasto-modal">Registrar gasto</x-button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <livewire:gastos-fijos-table/>
        </div>
    </div>
</div>
