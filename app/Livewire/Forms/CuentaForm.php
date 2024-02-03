<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CuentaForm extends Form
{
    #[Validate(['array', 'min:1'])]
    public $items = [];
}
