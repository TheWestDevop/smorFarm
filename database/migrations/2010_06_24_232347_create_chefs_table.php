<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chefs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('phone');
            $table->string('address');
            $table->string('expertise');
            $table->string('experience_years');
            $table->string('service_cost');
            $table->tinyinteger('chef_status');
            $table->string('next_kin');
            $table->string('next_kin_address');
            $table->string('state_province');
            $table->string('country');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chefs');
    }
}
