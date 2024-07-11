<?php

use App\Livewire\Login;
use App\Models\User;

use function Pest\Livewire\livewire;

test('se muestran los campos del login correctamente', function () {
    livewire(Login::class)
        ->assertPropertyWired('form.email')
        ->assertPropertyWired('form.password');
});

test('Se valida que exista el método login', function () {
    livewire(Login::class)
        ->assertMethodWiredToForm('login')
        ->call('login');
});

test('Se valida que al enviar el correo y la contraseña, se inicie sesión', function () {
    $user = User::factory()->make();
    livewire(Login::class)
        ->set('form.email', $user->email)
        ->set('form.password', 'password')
        ->call('login')
        ->assertHasNoErrors();
});
