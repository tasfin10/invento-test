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
        Schema::create('admin_password_resets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email', 40)->nullable();
            $table->string('code', 40)->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_password_resets');
    }
};
