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
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 40);
            $table->string('email', 40)->unique('email');
            $table->string('username', 40)->unique('username');
            $table->string('contact', 40)->nullable();
            $table->string('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('image')->nullable();
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
