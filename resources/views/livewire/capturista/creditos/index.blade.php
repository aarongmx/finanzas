<div class="container-fluid p-4">
    <x-modal id="credito-modal">
        <livewire:capturista.creditos.form/>
    </x-modal>

    <x-modal id="abono-modal">
        <livewire:capturista.pagos.form/>
    </x-modal>

    <div class="row mb-3">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <h1 class="h3">Créditos</h1>
            <x-button data-bs-target="#credito-modal" data-bs-toggle="modal">Registrar crédito</x-button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <livewire:creditos-table/>
        </div>
    </div>
</div>
