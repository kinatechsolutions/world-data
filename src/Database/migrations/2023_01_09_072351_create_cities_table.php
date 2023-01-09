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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("state_code")->nullable();
            $table->string("country_code")->nullable();
            $table->decimal("latitude")->nullable();
            $table->decimal("longitude")->nullable();
            $table->timestamps();

            $table->index(["name", "state_code", "country_code"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
};
