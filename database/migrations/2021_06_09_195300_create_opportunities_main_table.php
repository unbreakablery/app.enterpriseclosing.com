<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpportunitiesMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunities_main', function (Blueprint $table) {
            $table->id();
            $table->integer('user');
            $table->string('opportunity');
            $table->string('usecase')->nullable();
            $table->string('emp_num')->nullable();
            $table->date('close_date')->format('dd-mm-yyyy')->nullable();
            $table->string('stage')->nullable();
            $table->string('next_step')->nullable();
            $table->string('amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('lead_source')->nullable();
            $table->string('compelling_event')->nullable();
            $table->string('user_num')->nullable();
            $table->string('sponsor')->nullable();
            $table->text('what_new_changed')->nullable();
            $table->string('red_flags')->nullable();
            $table->string('folder_link')->nullable();
            $table->tinyInteger('competitive_position')->nullable();
            $table->tinyInteger('progress_barometer')->nullable();
            $table->string('organisation')->nullable();
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
        Schema::dropIfExists('opportunities_main');
    }
}
