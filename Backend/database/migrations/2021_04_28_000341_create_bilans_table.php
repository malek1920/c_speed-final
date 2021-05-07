<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBilansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bilans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('code_compte');
            $table->text('nom_compte');
            $table->float('montant_actif');
            $table->float('montant_passif');
            $table->integer('actif');
            $table->integer('passif');
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
        Schema::dropIfExists('bilans');
    }
}
