<?php

namespace App\Livewire\Forms;

use App\Models\Direccion;
use App\Models\Sucursal;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Form;

class SucursalForm extends Form
{
    #[Rule(['required'])]
    public string $nombre;

    #[Rule(['required'])]
    public string $codigo_postal;

    #[Rule(['nullable'])]
    public ?string $colonia = null;

    #[Rule(['nullable'])]
    public ?string $estado = null;

    #[Rule(['nullable'])]
    public ?string $numero_interior = null;

    #[Rule(['nullable'])]
    public ?string $numero_exterior = null;

    #[Rule(['nullable'])]
    public ?string $calle = null;

    public function store()
    {
        DB::transaction(function () {
            $direccion = Direccion::create($this->except('nombre'));
            Sucursal::create([
                'nombre' => $this->nombre,
                'direccion_id' => $direccion->id,
            ]);
        });
    }
}
