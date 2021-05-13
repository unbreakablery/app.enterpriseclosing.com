<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('user');
            $table->string('action')->nullable();
            $table->string('step')->nullable();
            $table->string('from_to_account')->nullable();
            $table->string('opportunity')->nullable();
            $table->enum('priority', [1, 2, 3])->default(3);
            $table->date('by_date')->format('dd-mm-yyyy')->nullable();
            $table->date('completed_at')->nullable();
            $table->enum('status', [0, 1, 2])->default(0);
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
        Schema::dropIfExists('tasks');
    }
}
