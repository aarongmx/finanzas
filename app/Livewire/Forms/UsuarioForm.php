<?php

namespace App\Livewire\Forms;

use App\Enums\Role;
use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Form;

class UsuarioForm extends Form
{
    #[Rule(['required'])]
    public string $name;

    #[Rule(['required', 'email'])]
    public string $email;

    #[Rule(['required'])]
    public int $sucursalId;

    public function store()
    {
        $password = "password";
        $user = User::create([
            'email' => $this->email,
            'name' => $this->name,
            'password' => $password,
            'sucursal_id' => $this->sucursalId
        ]);

        $user->assignRole(Role::CAPTURISTA);

    }
}
