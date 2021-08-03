<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpportunitiesSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunities_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('user');
            $table->string('o_key');
            $table->string('o_value')->nullable();
            $table->tinyInteger('o_value1')->nullabel();
            $table->tinyInteger('o_value2')->nullabel();
            $table->tinyInteger('o_value3')->nullabel();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opportunities_settings');
    }
}
