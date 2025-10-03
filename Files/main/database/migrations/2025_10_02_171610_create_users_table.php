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
            $table->bigIncrements('id');
            $table->string('firstname', 40)->nullable();
            $table->string('lastname', 40)->nullable();
            $table->string('username', 40);
            $table->string('email', 40);
            $table->string('country_code', 40)->nullable();
            $table->string('country_name', 40)->nullable();
            $table->string('mobile', 40)->nullable();
            $table->text('address')->nullable();
            $table->unsignedInteger('flat_count')->default(0);
            $table->unsignedInteger('assigned_tenant_count')->default(0);
            $table->string('password');
            $table->string('ver_code', 40)->nullable()->comment('stores verification code');
            $table->dateTime('ver_code_send_at')->nullable()->comment('verification send time');
            $table->string('remember_token')->nullable();
            $table->timestamps();

            $table->unique(['username', 'email'], 'username');
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
