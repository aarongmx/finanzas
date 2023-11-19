<?php

namespace App\Livewire\Administrador\Cuentas;

use App\Livewire\Forms\CuentaForm;
use App\Models\Categoria;
use App\Models\Producto;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Form extends Component
{
    public CuentaForm $form;

    public $categoriaSeleccionada;

    public $items = [];

    public function mount()
    {
        $this->items = Producto::query()->get()
            ->groupBy('categoria_id')
            ->map(fn($productos) => collect($productos)
                ->map(fn($producto) => [$producto->id => ['producto' => $producto->nombre, 'precio' => 0, 'kilos_existencia' => 0, 'kilos_entrada' => 0, 'kilos_sobrante' => 0, 'kilos_salida' => 0]]
                )
            )->toArray();
    }

    #[Computed]
    public function categorias()
    {
        return Categoria::query()->get();
    }

    public function tests()
    {
        ray($this->form->items);
    }

    public function render()
    {
        return view('livewire.administrador.cuentas.form');
    }
}
