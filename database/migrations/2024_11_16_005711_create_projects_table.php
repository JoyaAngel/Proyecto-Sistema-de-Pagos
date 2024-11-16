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
            $table->string('name', 100);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->float('subtotal');
            $table->string('concept', 200)->nullable();
            $table->string('comments', 200)->nullable();
            $table->timestamps();
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
