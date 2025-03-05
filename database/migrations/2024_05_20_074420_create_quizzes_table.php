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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->string('id');
            $table->integer('user_id')->default(1);
            $table->text('thumb')->nullable();
            $table->string('title');
            $table->text("description");
            $table->integer("status")->default(0)->comment("0: Draft,1:Pending,2: Published,3:Refused");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
