<?php

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
        Schema::create('tcardrivers', function (Blueprint $table) {
            $table->id();
            $table->string('plate', 7);
            $table->unsignedBigInteger('driver_id');

            $table->foreign('plate')->references('plate')->on('tcars')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('driver_id')->references('id')->on('tdrivers')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['plate', 'driver_id']); // no repetir la misma pareja
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tcardrivers');
    }
};
