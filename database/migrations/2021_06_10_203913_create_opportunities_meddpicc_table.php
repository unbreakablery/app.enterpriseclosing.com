<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpportunitiesMeddpiccTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunities_meddpicc', function (Blueprint $table) {
            $table->id();
            $table->integer('opp_id');
            $table->text('metrics')->nullable();
            $table->enum('metrics_score', [0, 1, 2])->default(0);
            $table->string('economic_buyer')->nullable();
            $table->enum('economic_buyer_score', [0, 1, 2])->default(0);
            $table->text('decision_criteria')->nullable();
            $table->enum('decision_criteria_score', [0, 1, 2])->default(0);
            $table->text('decision_process')->nullable();
            $table->enum('decision_process_score', [0, 1, 2])->default(0);
            $table->text('paper_process')->nullable();
            $table->enum('paper_process_score', [0, 1, 2])->default(0);
            $table->text('identified_pain')->nullable();
            $table->enum('identified_pain_score', [0, 1, 2])->default(0);
            $table->string('champion_coach')->nullable();
            $table->enum('champion_coach_score', [0, 1, 2])->default(0);
            $table->string('competition')->nullable();
            $table->enum('competition_score', [0, 1, 2])->default(0);
            $table->integer('meddpicc_score')->default(0);
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
        Schema::dropIfExists('opportunities_meddpicc');
    }
}
