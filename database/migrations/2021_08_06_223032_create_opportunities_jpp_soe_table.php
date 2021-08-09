<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpportunitiesJppSoeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunities_jpp_soe', function (Blueprint $table) {
            $table->id();
            $table->integer('opp_id');
            $table->integer('no')->nullable();
            $table->integer('task_event')->nullable();
            $table->tinyInteger('ownership')->default(0);
            $table->date('target_date')->format('dd-mm-yyyy')->nullable();
            $table->tinyInteger('completed')->default(0);
            $table->string('comments')->nullable();
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
        Schema::dropIfExists('opportunities_jpp_soe');
    }
}
