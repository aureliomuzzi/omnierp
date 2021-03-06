<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 2)->comment("PF = Pessoa Física | PJ = Pessoa Jurídica");
            $table->string('nome')->comment("Nome Completo se PF | Razão Social se PJ");
            $table->string('fantasia')->nullable();
            $table->string('cpf_cnpj');
            $table->string('classificacao', 50)->comment("MATRIZ | FILIAL | MEI | ONG | INDIVIDUAL");
            $table->boolean('cliente')->nullable();
            $table->boolean('fornecedor')->nullable();
            $table->boolean('transportador')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('pessoas');
    }
}
