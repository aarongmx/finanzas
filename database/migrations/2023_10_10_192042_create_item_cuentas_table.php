<?php

use App\Models\Cuenta;
use App\Models\Producto;
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
        Schema::create('item_cuentas', function (Blueprint $table) {
            $table->id();
            $table->unsignedDouble('precio', 16, 2);
            $table->unsignedDouble('cantidad_existencia', 16, 2);
            $table->unsignedDouble('importe_existencia', 16, 2);
            $table->unsignedDouble('cantidad_entrada', 16, 2);
            $table->unsignedDouble('importe_entrada', 16, 2);
            $table->unsignedDouble('cantidad_salida', 16, 2);
            $table->unsignedDouble('importe_salida', 16, 2);
            $table->unsignedDouble('cantidad_sobrante', 16, 2);
            $table->unsignedDouble('importe_sobrante', 16, 2);
            $table->foreignIdFor(Producto::class)->constrained('productos');
            $table->foreignIdFor(Cuenta::class)->constrained('cuentas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_cuentas');
    }
};
