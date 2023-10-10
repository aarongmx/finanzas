<?php

use App\Models\Direccion;
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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('rfc', 13)->unique('uk_rfc_cliente');
            $table->string('razon_social');
            $table->string('nombre_comercial')->nullable();
            $table->foreignIdFor(Direccion::class)->constrained('direcciones');
            $table->foreignIdFor(Sucursal::class)->constrained('sucursales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
