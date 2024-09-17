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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')
                  ->on('users')->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->string('name');
            $table->json('ingredients');
            $table->text('description');
            $table->text(column: 'instructions');
            $table->text(column: 'servings');

            $table->integer(column: 'prep_time');
            $table->integer(column: 'cook_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
