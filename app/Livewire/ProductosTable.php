<?php

namespace App\Livewire;

use App\Livewire\Administrador\Productos\Form;
use App\Models\Producto;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class ProductosTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Producto::query()
            ->withTrashed();
    }

    public function relationSearch(): array
    {
        return [
            'categoria:id,nombre',
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nombre')
            /** Example of custom column using a closure **/
            ->add('nombre_lower', fn(Producto $model) => strtolower(e($model->nombre)))
            ->add('categoria', fn(Producto $model) => $model->categoria->nombre)
            ->add('created_at_formatted', fn(Producto $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Nombre', 'nombre')
                ->sortable()
                ->searchable(),

            Column::make('Categoria', 'categoria'),
            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('nombre')->operators(['contains']),
            Filter::datetimepicker('created_at'),
        ];
    }

    #[On('edit')]
    public function edit($rowId): void
    {
        $this->dispatch('update', $rowId)->to(Form::class);
        $this->openModal('producto-form');
    }

    #[On('askDelete')]
    public function askDelete($rowId): void
    {
        $producto = Producto::query()->find($rowId);
        $producto->delete();
    }

    #[On('askRestore')]
    public function askRestore($rowId): void
    {
        $producto = Producto::query()->onlyTrashed()->find($rowId);
        $producto->restore();
    }

    public function actions(Producto $row): array
    {
        $buttons = [];

        if ($row->trashed()){
            $buttons = [
                Button::add('restore')
                    ->slot('Restaurar')
                    ->id()
                    ->class('btn btn-outline-primary')
                    ->dispatch('askRestore', ['rowId' => $row->id]),
            ];
        }

        if (!$row->trashed()) {
            $buttons = [
                Button::add('delete')
                    ->slot('Eliminar')
                    ->id()
                    ->class('btn btn-outline-danger')
                    ->dispatch('askDelete', ['rowId' => $row->id]),
                Button::add('edit')
                    ->slot('Actualizar')
                    ->id()
                    ->class('btn btn-primary')
                    ->dispatch('edit', ['rowId' => $row->id]),
            ];
        }
        return $buttons;
    }

    #[On('refresh')]
    public function refreshData(): void
    {
        $this->fillData();
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
