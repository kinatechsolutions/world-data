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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("iso2")->nullable();
            $table->string("iso3")->nullable();
            $table->string("numeric_code")->nullable();
            $table->string("phonecode")->nullable();
            $table->string("capital")->nullable();
            $table->string("currency")->nullable();
            $table->string("currency_name")->nullable();
            $table->string("currency_symbol")->nullable();
            $table->string("tld")->nullable();
            $table->string("native")->nullable();
            $table->string("region")->nullable();
            $table->string("subregion")->nullable();
            $table->longText("timezones")->nullable();
            $table->longText("translations")->nullable();
            $table->decimal("latitude")->nullable();
            $table->decimal("longitude")->nullable();
            $table->string("emoji")->nullable();
            $table->string("emojiU")->nullable();
            $table->timestamps();

            $table->index(["name", "iso2", "iso3"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
};
