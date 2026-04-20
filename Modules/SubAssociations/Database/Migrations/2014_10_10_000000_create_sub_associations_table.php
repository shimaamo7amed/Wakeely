<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubAssociationsTable extends Migration
{
    public function up()
    {
        Schema::create('sub_associations', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_ar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_associations');
    }
}
