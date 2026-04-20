<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('phone_code')->nullable();
            $table->string('country_code')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('short_name')->nullable();
            $table->string('cpr')->nullable();
            $table->date('birthdate')->nullable();
            $table->enum('gender', ['M', 'F'])->nullable();
            $table->string('accent')->nullable();
            $table->string('image')->nullable();
            $table->text('bio')->nullable();
            $table->boolean('status')->default(1);
            $table->string('password');
            $table->string('code')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
