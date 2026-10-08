<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lessen', function (Blueprint $table) {
            $table->id();
            $table->date('datum');
            $table->time('tijd');
            $table->string('activiteit');
            $table->unsignedBigInteger('trainer_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lessen');
    }
};
