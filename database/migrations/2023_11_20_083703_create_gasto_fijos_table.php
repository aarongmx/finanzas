<?php

use App\Models\Cuenta;
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
        Schema::create('gasto_fijos', function (Blueprint $table) {
            $table->id();
            $table->float('precio', 14);
            $table->string('concepto');
            $table->foreignIdFor(Sucursal::class)->constrained('sucursales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gasto_fijos');
    }
};
