<?php

use App\Models\Cuenta;
use App\Models\GastoFijo;
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
        Schema::create('cuenta_gasto_fijo', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Cuenta::class);
            $table->foreignIdFor(GastoFijo::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuenta_gasto_fijo');
    }
};
