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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('idTransaction')->autoIncrement();
            $table->foreignId('idOrganization');
            $table->float('amount');
            $table->char('type', 1);
            $table->string('method');
            $table->string('reference')->nullable();
            $table->date('date');;
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
