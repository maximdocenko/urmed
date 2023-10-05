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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('photo')->nullable();
            $table->integer('balance')->default(0);
            $table->integer('price')->default(0);
            $table->string('role')->nullable();
            //$table->longText('qualification')->nullable();
            //$table->longText('education')->nullable();
            //$table->longText('training')->nullable();
            //$table->longText('clinic')->nullable();
            //$table->longText('address')->nullable();
            $table->integer('status')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
