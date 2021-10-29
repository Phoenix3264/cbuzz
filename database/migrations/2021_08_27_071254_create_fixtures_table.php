<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();

            $table->integer('leagues_id');
            $table->tinyInteger('round_league');

            $table->integer('home_clubs_id');
            $table->integer('away_clubs_id');

            //goals
                $table->tinyInteger('home_goals')->nullable();
                $table->tinyInteger('away_goals')->nullable();

                $table->double('home_hdp_goals', 2, 2)->nullable();
                $table->double('away_hdp_goals', 2, 2)->nullable();

                $table->double('home_avg_goals', 2, 2)->nullable();
                $table->double('away_avg_goals', 2, 2)->nullable();

                $table->double('over_under_goals', 2, 2)->nullable();

                $table->tinyInteger('hdp_goals_status')->nullable();
                $table->tinyInteger('ou_goals_status')->nullable();

            //corner
                $table->tinyInteger('home_corners')->nullable();
                $table->tinyInteger('away_corners')->nullable();

                $table->double('home_hdp_corners', 2, 2)->nullable();
                $table->double('away_hdp_corners', 2, 2)->nullable();

                $table->double('home_avg_corners', 2, 2)->nullable();
                $table->double('away_avg_corners', 2, 2)->nullable();

                $table->double('over_under_corners', 2, 2)->nullable();

                $table->tinyInteger('ou_corners_status')->nullable();

            $table->string('my_bet')->nullable();
            $table->tinyInteger('bet_status')->nullable();
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
        Schema::dropIfExists('fixtures');
    }
}
