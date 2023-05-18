<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRealEstateTable extends Migration
{
    public function up()
    {
        Schema::table('real_estates', function (Blueprint $table) {
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id', 'location_fk_8461454')->references('id')->on('locations');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_8461468')->references('id')->on('users');
        });
    }
}
