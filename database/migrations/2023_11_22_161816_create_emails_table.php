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
        Schema::create('emails', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('microsoft_email_id');

            $table->json('to')->nullable();
            $table->json('from')->nullable();
            $table->string('subject')->nullable();
            $table->string('web_link')->nullable();
            $table->longText('message');
            $table->dateTime('sent_at');
            $table->dateTime('received_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};
