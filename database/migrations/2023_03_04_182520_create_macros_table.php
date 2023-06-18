<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Macro;

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
            $table->enum('name', Macro::TYPES);
            $table->integer('value');
            $table->enum('display_unit', Macro::DISPLAY_UNIT_OPTIONS)->nullable();
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
