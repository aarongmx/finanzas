<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mayoreos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_venta');
            $table->float('precio', 16);
            $table->float('cantidad', 16);
            $table->float('total', 16);
            $table->foreignIdFor(\App\Models\Producto::class)->constrained('productos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mayoreos');
    }
};
