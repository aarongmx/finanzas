<?php

namespace App\Livewire\Capturista\Mayoreo;

use App\Livewire\Forms\MayoreoForm;
use App\Models\Producto;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Form extends Component
{
    public MayoreoForm $form;

    public function store()
    {
        $this->validate();
        $this->form->store();
        $this->form->reset();
        $this->closeModal('mayoreo');
        $this->dispatch('refresh');
        $this->notify('Mayoreo registrado', 'Salida por mayoreo registrada corectamente!');
    }

    #[Computed]
    public function productos()
    {
        return Producto::query()->select(['id', 'nombre'])->orderBy('nombre')->get();
    }

    public function render()
    {
        return view('livewire.capturista.mayoreo.form');
    }
}
