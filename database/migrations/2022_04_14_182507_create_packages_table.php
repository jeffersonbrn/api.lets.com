<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('position_id')->default(1);
            $table->string('name', 255);
            $table->string('description', 255);
            $table->string('code_tracking', 255);
            $table->string('cep', 8);
            $table->string('road', 255);
            $table->string('number', 10)->nullable();
            $table->string('district', 255);
            $table->string('complement', 255)->nullable();
            $table->string('state', 255);
            $table->string('city', 255);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('position_id')->references('id')->on('positions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
