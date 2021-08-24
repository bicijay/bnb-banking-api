<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_balance', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->index();
            $table->bigInteger("current_balance")->default(0);
            $table->bigInteger("total_incomes")->default(0);
            $table->bigInteger("total_expenses")->default(0);
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
        Schema::dropIfExists('users_balance');
    }
}
