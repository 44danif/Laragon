<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tcars', function (Blueprint $table) {
            $table->string('color', 30)->nullable()->after('model');
            // Alternativa con valor por defecto:
            // $table->string('color', 30)->default('Sin especificar')->after('model');
        });
    }

    public function down(): void
    {
        Schema::table('tcars', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
};