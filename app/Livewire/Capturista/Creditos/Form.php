<?php

namespace App\Livewire\Capturista\Creditos;

use App\Livewire\Forms\CreditoForm;
use App\Models\Cliente;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Form extends Component
{
    public CreditoForm $form;

    #[Computed]
    public function clientes()
    {
        return Cliente::query()
            ->select(['id', 'nombre_comercial'])
            ->where('sucursal_id', auth()->user()->sucursal_id)
            ->get();
    }

    public function store()
    {
        $this->validate();
        try {
            $this->form->store();
            $this->closeModal('credito-modal');
            $this->notify('Crédito registrado correctamente', 'El crédito se registro correctamente!');
            $this->dispatch('refresh');
        } catch (\Exception $exception) {
            logger($exception);
        }
    }

    public function render()
    {
        return view('livewire.capturista.creditos.form');
    }
}
