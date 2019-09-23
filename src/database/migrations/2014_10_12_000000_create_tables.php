<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();

            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::dropIfExists('social_accounts');
        Schema::create('social_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('provider');
            $table->string('provider_id');
            $table->timestamps();
        });

        Schema::dropIfExists('t_shift');
        Schema::create('t_shift', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->nullable();
            $table->integer('work_type')->nullable()->default(0);
            $table->date('business_day_start')->nullable()->default(null);
            $table->date('business_day_end')->nullable()->default(null);
            $table->date('business_day')->nullable()->default(null);
            $table->time('start_time')->nullable()->default(null);
            $table->time('end_time')->nullable()->default(null);
            $table->integer('rest_time')->default(0);
            $table->timestamps();
        });

        Schema::dropIfExists('t_timesheet');
        Schema::create('t_timesheet', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->nullable();
            $table->integer('work_type')->default(0);
            $table->integer('work_place_type')->default(0);
            $table->date('business_day')->nullable()->default(null);
            $table->time('start_time')->nullable()->default(null);
            $table->time('end_time')->nullable()->default(null);
            $table->integer('rest_time')->default(0);
            $table->timestamps();
        });

        Schema::dropIfExists('password_resets');
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_accounts');
        Schema::dropIfExists('password_resets');

        Schema::dropIfExists('t_shift');
        Schema::dropIfExists('users');
    }
}
