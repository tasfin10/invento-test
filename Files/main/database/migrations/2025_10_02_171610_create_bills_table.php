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
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unique_id', 40)->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('flat_id');
            $table->unsignedInteger('category_id');
            $table->string('month', 40)->nullable();
            $table->decimal('amount', 28, 8);
            $table->text('notes')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
