<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('Clean Up');
            $table->string('status')->default('Registration is open');
            $table->text('description')->nullable();
            $table->string('date');
            $table->string('time')->nullable();
            $table->string('location');
            $table->string('quota')->default('100');
            $table->integer('registered_count')->default(0);
            $table->string('image')->default('/images/about_1.png');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
