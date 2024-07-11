<?php

namespace App\Livewire\Administrador\Productos;

use App\Livewire\Forms\ProductoForm;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Form extends Component
{
    public ProductoForm $form;

    #[On('update')]
    public function edit(Producto $producto)
    {
        $this->form->setForm($producto);
    }

    #[Computed]
    public function categorias(): Collection
    {
        return Categoria::query()->get();
    }

    public function store()
    {
        $this->validate();
        try {
            $this->form->store();
            $this->dispatch('refresh');
            $this->form->reset();
            $this->closeModal('producto-form');
            $this->notify('Producto guardaro!', 'El producto quedo registrado correctamente!');
        } catch (\Exception $exception) {
            logger($exception);
            $this->notify('Hubo un error al intentar crear el producto!', 'Intente crear el producto en otro momento', 'error');
        }

    }

    public function render()
    {
        return view('livewire.administrador.productos.form');
    }
}
