<?php

use App\Models\Cuenta;
use App\Models\Producto;
use App\Models\Sucursal;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salidas', function (Blueprint $table) {
            $table->id();
            $table->float('precio', 14);
            $table->float('cantidad', 14);
            $table->float('total', 14);
            $table->date('fecha_salida');
            $table->foreignIdFor(Producto::class)->constrained('productos');
            $table->foreignIdFor(Cuenta::class)->constrained('cuentas');
            $table->foreignIdFor(Sucursal::class, 'sucursal_destino_id')->constrained('sucursales');
            $table->foreignIdFor(Sucursal::class, 'sucursal_origen_id')->constrained('sucursales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salidas');
    }
};
