<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_partners', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('pre_income_from');
            $table->integer('pre_income_to');
            $table->enum('pre_manglik', ['yes', 'no','both']);
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
        Schema::dropIfExists('pre_partners');
    }
}
