<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto', function (Blueprint $table) {
            $table->id();
            $table->string('nome_produto');
            $table->float('valor_produto', 10, 2);
            $table->unsignedBigInteger('id_categoria_produto');
            $table->timestamps();
        });

        Schema::table('produto', function(Blueprint $table) {
            $table->foreign('id_categoria_produto')->references('id')->on('categoria_produto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto');
    }
}
