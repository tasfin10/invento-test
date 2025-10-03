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
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('site_name', 40)->nullable();
            $table->unsignedInteger('per_page_item')->default(20);
            $table->string('email_from', 40)->nullable();
            $table->text('email_template')->nullable();
            $table->string('sms_body')->nullable();
            $table->string('sms_from')->nullable();
            $table->text('mail_config')->nullable();
            $table->text('sms_config')->nullable();
            $table->text('universal_shortcodes')->nullable();
            $table->unsignedTinyInteger('enforce_ssl')->default(0)->comment('enforce ssl');
            $table->unsignedTinyInteger('ea')->default(0)->comment('email alert');
            $table->unsignedTinyInteger('sa')->default(0)->comment('sms alert');
            $table->string('active_theme', 40)->default('primary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
