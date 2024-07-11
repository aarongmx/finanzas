<?php

namespace App\Livewire\Forms;

use Domain\Clientes\Actions\RegistrarClienteAction;
use Domain\Clientes\Data\ClienteData;
use Domain\Direcciones\Actions\StoreDireccionAction;
use Domain\Direcciones\Data\DireccionData;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Form;

class ClienteForm extends Form
{
    public DireccionForm $direccionForm;

    #[Rule(['required', 'min:12', 'max:13', 'unique:clientes,rfc'])]
    public $rfc;

    #[Rule(['required'])]
    public $razonSocial;

    #[Rule(['nullable', 'string'])]
    public $nombreComercial;

    #[Rule(['required', 'string', 'max:5'])]
    public $codigoPostal;

    #[Rule(['nullable'])]
    public $colonia;

    #[Rule(['nullable'])]
    public $estado;

    #[Rule(['nullable'])]
    public $numeroInterior;

    #[Rule(['nullable'])]
    public $numeroExterior;

    #[Rule(['nullable'])]
    public $calle;

    #[Rule(['nullable', 'integer'])]
    public ?int $sucursalId = null;

    public function store()
    {
        DB::transaction(function () {
            $direccionData = DireccionData::from($this->only([
                'codigoPostal',
                'colonia',
                'estado',
                'numeroInterior',
                'numeroExterior',
                'calle',
            ]));

            $direccion = (new StoreDireccionAction)($direccionData);

            $clienteData = ClienteData::from([
                ...$this->only(['rfc', 'razonSocial', 'nombreComercial']),
                'sucursalId' => auth()->user()->sucursal_id ?? $this->sucursalId,
                'direccionId' => $direccion->id,
            ]);
            (new RegistrarClienteAction)($clienteData);
        });
    }
}
