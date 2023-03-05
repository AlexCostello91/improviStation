<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('macros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_item_id')->constrained()->cascadeOnDelete();
            $table->enum('name', ['fat','protein','carbs','sugar','sodium','fiber','calories']);
            $table->integer('value');
            $table->enum('display_unit',['g','mg'])->default('g');
            $table->timestamps();
            $table->unique(['name', 'meal_item_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('macros');
    }
};
