<div class="container py-lg-4">
    <x-modal id="mayoreo">
        <livewire:capturista.mayoreo.form/>
    </x-modal>
    <div class="row">
        <div class="col-12">
            <h1>Mayoreos</h1>
            <x-button data-bs-target="#mayoreo" data-bs-toggle="modal">Nuevo</x-button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <livewire:mayoreos-table/>
        </div>
    </div>
</div>
