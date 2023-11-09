<?php

namespace App\Livewire\Productos;

use App\Livewire\Forms\ProductoForm;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Form extends Component
{
    public ProductoForm $form;

    #[Computed]
    public function categorias(): Collection
    {
        return Categoria::query()->get();
    }

    public function store()
    {
        $this->validate();
        $this->form->store();
        $this->dispatch('refresh')->to(Index::class);
        $this->closeModal('exampleModal');
        $this->notify('Producto guardaro!', 'El producto quedo registrado correctamente!');
    }

    public function render()
    {
        return view('livewire.productos.form');
    }
}
