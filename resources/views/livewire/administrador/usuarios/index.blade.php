<div class="container-fluid p-4">
    <x-modal id="usuarios-modal">
        <livewire:administrador.usuarios.form/>
    </x-modal>
    <div class="row mb-3">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <h1 class="h3">Usuarios</h1>
            <x-button data-bs-target="#usuarios-modal" data-bs-toggle="modal">Registrar usuarios</x-button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <livewire:users-table/>
        </div>
    </div>
</div>
