<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutboundPersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outbound_persons', function (Blueprint $table) {
            $table->id();
            $table->integer('o_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('title')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('calls')->nullable();
            $table->string('result')->nullable();
            $table->string('li_connected')->nullable();
            $table->string('notes')->nullable();
            $table->string('li_address')->nullable();
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
        Schema::dropIfExists('outbound_persons');
    }
}
