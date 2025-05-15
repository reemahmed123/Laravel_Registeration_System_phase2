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
        //
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('full_name');
            $table->string('user_name')->unique();
            $table->string('phone', 20);
            $table->string('whatsapp', 20);
            $table->text('address');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('user_image');
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
