<?php

use App\Livewire\Cuentas\Form;
use App\Models\Categoria;
use App\Models\Producto;
use function Pest\Livewire\livewire;

it('renders successfully', function () {
    livewire(Form::class)
        ->assertStatus(200);
});

test('Se muestran las categorias correctamente', function () {
    Categoria::factory()->count(2)->create();

    $categorias = Categoria::query()->get();

    livewire(Form::class)
        ->assertSet('categorias', $categorias)
        ->assertSee($categorias->first()->nombre);
});

describe('Se valida la agrupación y seleccion de datos por categoria', function () {

    beforeEach(function () {
        Categoria::factory()->count(2)->create();
        Producto::factory()->count(10)->create(['categoria_id' => 1]);
        Producto::factory()->count(10)->create(['categoria_id' => 2]);

        $this->items = Producto::query()->get()->groupBy('categoria_id')->map(fn($productos) => collect($productos)->map(fn($p) => [$p->id => ['producto' => $p->nombre, 'precio' => 0, 'kilos_existencia' => 0, 'kilos_entrada' => 0, 'kilos_sobrante' => 0, 'kilos_salida' => 0]]
        ))->toArray();
    });

    test('Se muestran los items agrupados por categoria', function () {
        livewire(Form::class)
            ->assertSet('items', $this->items);
    });

    test('Se puede seleccionar la categoria para llenar datos', function () {
        $categoriaSeleccionadaId = 1;
        $firstItems = $this->items[$categoriaSeleccionadaId];

        livewire(Form::class)
            ->assertPropertyWired('categoriaSeleccionada')
            ->set('categoriaSeleccionada', 1)
            ->assertSee($firstItems[0][1]['producto']);
    });
});
