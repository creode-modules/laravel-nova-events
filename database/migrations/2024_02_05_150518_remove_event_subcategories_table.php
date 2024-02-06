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
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign('events_sub_category_id_foreign');
        });

        if (!Schema::hasTable('event_sub_categories')) {
            return;
        }

        Schema::table('event_sub_categories', function (Blueprint $table) {
            $table->dropForeign('event_sub_categories_category_id_foreign');
            $table->dropIndex('event_sub_categories_category_id_foreign');
        });

        Schema::drop('event_sub_categories');
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
