<?php

namespace App\Livewire\Administrador\Usuarios;

use App\Livewire\Forms\UsuarioForm;
use App\Models\Sucursal;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Form extends Component
{
    public UsuarioForm $form;

    #[Computed]
    public function sucursales()
    {
        return Sucursal::query()->select(['id', 'nombre'])->get();
    }

    public function store()
    {
        $this->validate();
        try {
            $this->form->store();
            $this->closeModal('usuarios-modal');
            $this->notify('Usuario registrado correctamente!', 'El usuario quedo registrado correctamente');
            $this->dispatch('refresh');
        } catch (\Exception $exception) {
            logger($exception);
        }
    }

    public function render()
    {
        return view('livewire.administrador.usuarios.form');
    }
}
