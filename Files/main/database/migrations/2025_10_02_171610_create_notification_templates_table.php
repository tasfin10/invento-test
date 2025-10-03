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
        Schema::create('notification_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('act', 40)->nullable();
            $table->string('name', 40)->nullable();
            $table->string('subj')->nullable();
            $table->text('email_body')->nullable();
            $table->text('sms_body')->nullable();
            $table->text('shortcodes')->nullable();
            $table->boolean('email_status')->default(true);
            $table->boolean('sms_status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_templates');
    }
};
