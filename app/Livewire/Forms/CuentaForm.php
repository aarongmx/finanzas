<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class CuentaForm extends Form
{
    #[Rule(['array', 'min:1'])]
    public $items = [];
}
