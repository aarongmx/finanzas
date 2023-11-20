<div class="container-fluid p-4">
    <x-modal id="gasto-modal">

    </x-modal>
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-between">
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
