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
        Schema::create('project_suppliers', function (Blueprint $table) {
            $table->id('idProjectSupplier')->autoIncrement();
            $table->foreignId('prsuIdProject');
            $table->foreignId('prsuIdSupplier');
            $table->timestamps();

            $table->foreign('prsuIdProject')->references('idProject')->on('projects')->onDelete('cascade');
            $table->foreign('prsuIdSupplier')->references('idSupplier')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_suppliers');
    }
};
