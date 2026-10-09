<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('les_aanmeldingen', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('les_id')
                ->constrained('lessen')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['user_id', 'les_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('les_aanmeldingen');
    }
};