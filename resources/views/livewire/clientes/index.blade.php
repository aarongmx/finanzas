<div class="container py-4">
    <x-modal id="exampleModal">
        <livewire:clientes.form/>
    </x-modal>
    <div class="row mb-3">
        <div class="col-12">
            <h1>Clientes</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Launch demo modal
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <livewire:cliente-table/>
        </div>
    </div>
</div>
