<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpportunitiesMeddpiccTooltipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunities_meddpicc_tooltip', function (Blueprint $table) {
            $table->id();
            $table->integer('user');
            $table->text('metrics')->nullable();
            $table->text('metrics_score')->nullable();
            $table->text('economic_buyer')->nullable();
            $table->text('economic_buyer_score')->nullable();
            $table->text('decision_criteria')->nullable();
            $table->text('decision_criteria_score')->nullable();
            $table->text('decision_process')->nullable();
            $table->text('decision_process_score')->nullable();
            $table->text('paper_process')->nullable();
            $table->text('paper_process_score')->nullable();
            $table->text('identified_pain')->nullable();
            $table->text('identified_pain_score')->nullable();
            $table->text('champion_coach')->nullable();
            $table->text('champion_coach_score')->nullable();
            $table->text('competition')->nullable();
            $table->text('competition_score')->nullable();
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
        Schema::dropIfExists('opportunities_meddpicc_tooltip');
    }
}
