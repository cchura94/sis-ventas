<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string("nombre", 200);
            $table->decimal("precio", 10, 2)->nullable();
            $table->string("imagen", 200)->nullable();
            $table->integer("cantidad")->default(0);
            $table->text("descripcion")->nullable();
            $table->boolean("estado")->default(true);
            $table->bigInteger("categoria_id")->unsigned();
            
            $table->foreign("categoria_id")->references("id")->on("categorias");            

            $table->softDeletes();
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
        Schema::dropIfExists('productos');
    }
}
