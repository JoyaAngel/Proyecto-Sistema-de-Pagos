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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            //$table->char('type', 1);
            $table->enum('person', ['l', 'n']);
            $table->string('rfc', 13)->unique();
            $table->string('address');
            $table->string('email')->unique();
            $table->string('phone');
            $table->timestamps('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
