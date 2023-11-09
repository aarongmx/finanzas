<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class DireccionForm extends Form
{
    #[Rule(['required', 'string', 'max:5'])]
    public string $codigoPostal = '';
    public string $colonia = '';
    public string $estado = '';
    public string $numeroInterior = '';
    public string $numeroExterior = '';
    public string $calle = '';
}
