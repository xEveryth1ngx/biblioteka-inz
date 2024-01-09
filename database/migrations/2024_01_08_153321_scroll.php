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
        Schema::create('scrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->foreign('page_id')->references('id')->on('pages');
            $table->unsignedBigInteger('ip_id');
            $table->foreign('ip_id')->references('id')->on('ips');
            $table->integer('max_scroll');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scrolls');
    }
};
