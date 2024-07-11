<?php

use App\Models\Cuenta;
use App\Models\Empleado;
use App\Models\Estatus;
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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->float('monto', 14);
            $table->float('saldo', 14);
            $table->date('fecha_prestamo');
            $table->date('fecha_vencimiento');
            $table->foreignIdFor(Cuenta::class);
            $table->foreignIdFor(Estatus::class);
            $table->foreignIdFor(Empleado::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
