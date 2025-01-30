<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('plants', function (Blueprint $table) {
            $table->string('scientific_name')->nullable();
            $table->string('sunlight')->nullable();
            $table->string('growth_rate')->nullable();
            $table->string('planting_season')->nullable();
            $table->string('care_level')->nullable();
        });
    }

    public function down(): void {
        Schema::table('plants', function (Blueprint $table) {
            $table->dropColumn([
                'scientific_name',
                'sunlight',
                'growth_rate',
                'planting_season',
                'care_level',
            ]);
        });
    }
};
