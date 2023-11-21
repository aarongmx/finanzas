<?php

use App\Models\Cliente;
use App\Models\Cuenta;
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
        Schema::create('creditos', function (Blueprint $table) {
            $table->id();
            $table->float('monto', 14);
            $table->float('saldo', 14);
            $table->date('fecha_credito');
            $table->date('fecha_vencimiento');
            $table->foreignIdFor(Cliente::class);
            $table->foreignIdFor(Cuenta::class);
            $table->foreignIdFor(Estatus::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creditos');
    }
};
