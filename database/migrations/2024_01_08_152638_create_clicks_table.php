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
        Schema::create('clicks', function (Blueprint $table) {
            $table->id();
            $table->string('element_type');
            $table->string('element_id');
            $table->string('element_classes');
            $table->unsignedBigInteger('page');
            $table->foreign('page')->references('id')->on('pages');
            $table->unsignedBigInteger('x_axis');
            $table->unsignedBigInteger('y_axis');
            $table->unsignedBigInteger('width');
            $table->unsignedBigInteger('height');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clicks');
    }
};
