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
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->string("channel", 500)->nullable();
            $table->text("token")->nullable();
            $table->integer("order_id")->default(0);
            $table->integer("expert_id")->default(0);
            $table->integer("user_id")->default(0);
            $table->integer("format")->default(0);
            $table->date('date');
            $table->time('time');
            $table->integer("status")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calls');
    }
};
