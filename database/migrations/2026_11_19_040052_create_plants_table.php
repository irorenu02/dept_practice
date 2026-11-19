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
    Schema::create('plants', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->string('plant_name');
        $table->string('category');
        $table->decimal('unit_price', 10, 2);
        $table->text('description');
        $table->string('stock_status');

        $table->timestamps();

        // Improve filtering performance in reports.
        $table->index(['category', 'stock_status']);
    });
}

public function down(): void
{
    Schema::dropIfExists('plants');
}

};