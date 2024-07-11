<?php

use App\Livewire\Administrador\Cuentas\Form;
use App\Models\Categoria;
use App\Models\Cuenta;
use App\Models\ItemCuenta;
use App\Models\Producto;
use App\Models\Sucursal;
use Database\Seeders\CategoriasSeeder;
use Database\Seeders\ProductosSeeder;

use function Pest\Laravel\seed;
use function Pest\Livewire\livewire;

it('renders successfully', function () {
    livewire(Form::class)
        ->assertStatus(200);
});

test('Se muestran las sucursales disponibles', function () {
    Sucursal::factory()->count(7)->create();

    $sucursales = Sucursal::query()->select(['id', 'nombre'])->get();

    livewire(Form::class)
        ->assertSet('sucursales', $sucursales);
});

test('Se muestran las categorias correctamente', function () {
    Categoria::factory()->count(2)->create();

    $categorias = Categoria::query()->get();

    livewire(Form::class)
        ->assertSet('categorias', $categorias)
        ->assertSee($categorias->first()->nombre);
});

describe('Se muestra tabla de captura', function () {

    beforeEach(function () {
        seed([
            CategoriasSeeder::class,
            ProductosSeeder::class,
        ]);
    });

    test('Se muestran todos los productos', function () {
        // Act
        $cuenta = Cuenta::factory()->create(['fecha_venta' => today()->subDay()]);

        $productos = Producto::query()->get();
        $productos->each(function ($producto) use (&$cuenta) {
            ItemCuenta::factory()->create([
                'producto_id' => $producto->id,
                'cuenta_id' => $cuenta->id,
            ]);
        });

        // Arrange
        $items = Producto::query()
            ->with([
                'itemsCuenta' => fn ($q) => $q->whereHas('cuenta', fn ($q) => $q->where('fecha_venta', today()->subDay()))->limit(1),
            ])
            ->get();
        ray($items->first());
        $items = $items->map(function ($producto) {
            $item = $producto->itemsCuenta?->first();

            return [
                'producto_name' => $producto->nombre,
                'producto_id' => $producto->id,
                'precio' => $item->precio ?? 0,
                'importe_existencia' => $item->importe_existencia ?? 0,
                'cantidad_existencia' => $item->cantidad_existencia ?? 0,
                'cantidad_sobrante' => $producto->categoria_id === 2 ? $item->cantidad_sobrante : 0,
                'importe_sobrante' => $producto->categoria_id === 2 ? $item->importe_sobrante : 0,
                'categoria_id' => $producto->categoria_id,
            ];
        })->toArray();

        ray($items);

        // Assert
        livewire(Form::class)
            ->assertSet('items', $items);
    });
});
