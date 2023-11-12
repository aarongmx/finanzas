<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class DireccionForm extends Form
{
    #[Rule(['required', 'string', 'max:5'])]
    public string $codigoPostal = '';
    
    #[Rule(['nullable'])]
    public string $colonia = '';

    #[Rule(['nullable'])]
    public string $estado = '';

    #[Rule(['nullable'])]
    public string $numeroInterior = '';

    #[Rule(['nullable'])]
    public string $numeroExterior = '';

    #[Rule(['nullable'])]
    public string $calle = '';
}
