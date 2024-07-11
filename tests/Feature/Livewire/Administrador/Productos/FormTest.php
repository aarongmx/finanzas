<?php

use App\Livewire\Administrador\Productos\Form;
use App\Models\Categoria;

use function Pest\Livewire\livewire;

it('renders successfully', function () {
    livewire(Form::class)
        ->assertStatus(200);
});

test('Se muestran los campos para registrar el producto', function () {
    livewire(Form::class)
        ->assertMethodWiredToForm('store')
        ->assertPropertyWired('form.nombre')
        ->assertPropertyWired('form.categoria_id');
});

test('Se muestran las categorias disponibles', function () {
    Categoria::factory()->count(2)->create();
    $categorias = Categoria::query()->get();

    livewire(Form::class)
        ->assertSet('categorias', $categorias)
        ->assertSeeHtml("<option value=\"{$categorias->first()->id}\" wire:key=\"{$categorias->first()->id}\">{$categorias->first()->nombre}</option>");
});

test('Se guarda correctamente el producto', function () {
    $categoria = Categoria::factory()->create();

    livewire(Form::class)
        ->set('form.nombre', 'Pollo')
        ->set('form.categoria_id', $categoria->id)
        ->call('store')
        ->assertHasNoErrors()
        ->assertDispatched('refresh')
        ->assertDispatched('closeModal')
        ->assertDispatched('notify');
});
