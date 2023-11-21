<?php

namespace App\Livewire\Capturista\Pagos;

use App\Livewire\Forms\PagoForm;
use App\Models\Credito;
use Livewire\Attributes\On;
use Livewire\Component;

class Form extends Component
{
    public PagoForm $form;

    #[On('set-pagable')]
    public function mount(Credito $credito): void
    {
        $this->form->credito = $credito;
    }

    public function store()
    {
        $this->validate();
        try {
            $this->form->store();
            $this->closeModal('abono-modal');
            $this->notify('Abono aplicado correctamente!', 'El abono se aplico correctamente!');
            $this->dispatch('refresh');
        }catch (\Exception $exception){
            logger($exception);
        }
    }

    public function render()
    {
        return view('livewire.capturista.pagos.form');
    }
}
