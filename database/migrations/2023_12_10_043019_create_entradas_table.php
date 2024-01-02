<?php

use App\Models\Cuenta;
use App\Models\Producto;
use App\Models\Salida;
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
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->float('precio');
            $table->float('precio_envio');
            $table->float('cantidad');
            $table->foreignIdFor(Producto::class)->constrained();
            $table->foreignIdFor(Sucursal::class, 'sucursal_envio_id')->constrained('sucursales');
            $table->foreignIdFor(Sucursal::class, 'sucursal_destino_id')->constrained('sucursales');
            $table->foreignIdFor(Salida::class)->constrained();
            $table->foreignIdFor(Cuenta::class)->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
