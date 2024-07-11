<?php

use App\Models\Cuenta;
use App\Models\Mayoreo;
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
        Schema::create('cuenta_mayoreo', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Cuenta::class)->constrained('cuentas');
            $table->foreignIdFor(Mayoreo::class)->constrained('mayoreos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuenta_mayoreo');
    }
};
