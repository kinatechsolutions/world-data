<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('alpha2')->nullable();
            $table->string('langEN')->nullable();
            $table->string('langDE')->nullable();
            $table->string('langFR')->nullable();
            $table->string('langES')->nullable();
            $table->string('langIT')->nullable();
            $table->timestamps();

            $table->index(["alpha2", "langEN"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
};
