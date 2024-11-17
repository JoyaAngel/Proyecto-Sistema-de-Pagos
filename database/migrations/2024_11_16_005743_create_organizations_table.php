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
            $table->id('idOrganization')->autoIncrement();
            $table->string('name', 100);
            $table->char('type', 1);
            $table->char('person', 1);
            $table->char('rfc', 13)->unique();
            $table->string('address', 150);
            $table->string('email', 100)->unique();
            $table->char('phone', 10);
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
