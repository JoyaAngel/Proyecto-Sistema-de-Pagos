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
        Schema::create('projects', function (Blueprint $table) {
            $table->id('idProject')->autoIncrement();
            $table->foreignId('projIdClient');
            $table->string('name', 100);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->float('subtotal');
            $table->float('tax');
            $table->float('total');
            $table->string('concept', 200)->nullable();
            $table->string('comments', 200)->nullable();
            $table->timestamps();

            $table->foreign('projIdClient')->references('idClient')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
