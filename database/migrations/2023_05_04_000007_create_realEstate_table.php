<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstateTable extends Migration
{
    public function up()
    {
        Schema::create('real_estates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->string('address');
            $table->float('latitude', 15, 8)->nullable();
            $table->float('longitude', 15, 8)->nullable();
            $table->longText('description')->nullable();
            $table->integer('area');
            $table->integer('number_of_rooms');
            $table->integer('number_of_beds')->nullable();
            $table->integer('floor')->nullable();
            $table->integer('price');
            $table->boolean('is_featured')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
