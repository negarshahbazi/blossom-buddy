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
        Schema::table('plants', function (Blueprint $table) {
            $table->string('common_name')->nullable();
            $table->string('scientific_name')->nullable();
            $table->json('other_names')->nullable();
            $table->string('image_url')->nullable();
            $table->string('cycle')->nullable();
            $table->string('watering')->nullable();
            $table->string('sunlight')->nullable();
            $table->boolean('indoor')->nullable();
            $table->integer('hardiness')->nullable();
            $table->boolean('edible')->nullable();
            $table->boolean('poisonous')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plants', function (Blueprint $table) {
            $table->dropColumn([
               'common_name', 'scientific_name', 'other_names', 'image_url', 'cycle', 
                'watering', 'sunlight', 'indoor', 'hardiness', 'edible', 'poisonous'
            ]);
        });
    }
};
