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
        Schema::dropIfExists('event_sub_categories');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('event_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->foreignId('category_id')->constrained('event_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }
};
