<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();

            $table->integer('leagues_id');
            $table->tinyInteger('round_league');

            $table->string('code_match');

            $table->integer('teams_id');
            $table->tinyInteger('type');

            $table->tinyInteger('goals')->nullable();
            $table->double('avg_goals', 2, 2)->nullable();


            $table->tinyInteger('corners')->nullable();
            $table->double('avg_corners', 2, 2)->nullable();


            $table->tinyInteger('status')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histories');
    }
}
