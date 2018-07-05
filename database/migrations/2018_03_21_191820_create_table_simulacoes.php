<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSimulacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('simulacoes', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('user_id');
            $table->tinyInteger('finalidade_id');
            $table->string('credito');
            $table->string('lance');
            $table->string('parcela');
            $table->tinyInteger('pressa');
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
        //Schema::drop('simulacoes');
    }
}
