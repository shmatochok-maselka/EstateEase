<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstateRealEstateTypePivotTable extends Migration
{
    public function up()
    {
        Schema::create('real_estate_real_estate_type', function (Blueprint $table) {
            $table->unsignedBigInteger('real_estate_id');
            $table->foreign('real_estate_id', 'real_estate_id_fk_8461455')->references('id')->on('real_estates')->onDelete('cascade');
            $table->unsignedBigInteger('real_estate_type_id');
            $table->foreign('real_estate_type_id', 'real_estate_type_id_fk_8461455')->references('id')->on('real_estate_types')->onDelete('cascade');
        });
    }
}
