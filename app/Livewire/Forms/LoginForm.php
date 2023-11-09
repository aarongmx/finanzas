<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Form;

class LoginForm extends Form
{
    #[Rule(['required', 'email'])]
    public string $email = '';

    #[Rule(['required', 'min:8'])]
    public string $password = '';

    public function login()
    {
        $this->validate();
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();

            return redirect()->intended('clientes');
        }
    }
}
