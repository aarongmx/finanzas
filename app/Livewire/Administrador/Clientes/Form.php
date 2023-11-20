<?php

namespace App\Livewire\Administrador\Clientes;

use App\Livewire\Forms\ClienteForm;
use App\Models\Sucursal;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Form extends Component
{
    public ClienteForm $form;

    public function save()
    {
        $this->validate();
        try {
            $this->form->store();
            $this->dispatch('refresh')->to(Index::class);
            $this->closeModal('nuevo-cliente-modal');
            $this->notify('Cliente guardaro!', 'El cliente se registro correctamente!');
        } catch (\Exception $exception) {
            logger($exception);
            $this->notify('Hubo un error al intentar crear el cliente!', 'Intente crear el cliente en otro momento', 'error');
        }
    }

    #[Computed]
    public function sucursales()
    {
        return Sucursal::query()->select(['id', 'nombre'])->get();
    }

    public function render()
    {
        return view('livewire.administrador.clientes.form');
    }
}
