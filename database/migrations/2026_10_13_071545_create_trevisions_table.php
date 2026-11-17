<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
    Schema::create('trevisions', function (Blueprint $table) {
        $table->id();
        $table->string('plate', 7);          // misma longitud que tcars.plate
        $table->date('data');
        $table->string('descripcio');
        $table->decimal('cost', 8, 2)->default(0);

        // Integridad referencial
        $table->foreign('plate')->references('plate')->on('tcars')
              ->OnUpdate('cascade')->OnDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('trevisions');
}
};
