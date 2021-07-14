<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->tinyInteger('active')->default(0);
            $table->tinyInteger('is_first_login')->default(1);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone')->nullable();
            $table->string('organisation')->nullable();
            $table->string('region')->nullable();
            $table->string('industry')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name',
                'phone',
                'organisation',
                'region',
                'industry'
            ]);
            
            $table->string('name');
        });
    }
}
