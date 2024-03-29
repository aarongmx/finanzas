<?php

use App\Models\EstadoCuenta;
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
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();
            $table->unsignedDouble('efectivo_pollo', 16, 2);
            $table->unsignedDouble('efectivo_marinado', 16, 2);
            $table->unsignedDouble('efectivo_total', 16, 2);
            $table->unsignedDouble('saldo', 16, 2);
            $table->date('fecha_captura')->default(now()->format('Y-m-d'));
            $table->date('fecha_venta')->default(now()->format('Y-m-d'));
            $table->foreignIdFor(Sucursal::class)->constrained('sucursales');
            $table->foreignIdFor(EstadoCuenta::class)->constrained('estado_cuentas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas');
    }
};
