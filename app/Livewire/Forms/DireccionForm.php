<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class DireccionForm extends Form
{
    #[Rule(['required', 'string', 'max:5'])]
    public $codigoPostal;
}
