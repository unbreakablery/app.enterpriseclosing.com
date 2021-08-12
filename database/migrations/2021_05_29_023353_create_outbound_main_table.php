<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutboundMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outbound_main', function (Blueprint $table) {
            $table->id();
            $table->integer('user');
            $table->string('account_name');
            $table->string('annual_report')->nullable();
            $table->text('pr_articles')->nullable();
            $table->text('org_hooks')->nullable();
            $table->text('additional_nuggets')->nullable();
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
        Schema::dropIfExists('outbound_main');
    }
}
