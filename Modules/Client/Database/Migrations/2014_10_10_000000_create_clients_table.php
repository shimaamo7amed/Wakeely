<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->nullable()->constrained('countries')->onUpdate('cascade')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('date_of_birth')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->enum('type', ['user', 'lawyer']);
            $table->string('terms')->default(false);
            $table->integer('current_step')->default(1);
            $table->boolean('is_submitted')->default(false);
            $table->json('rejected_steps')->nullable();
            $table->boolean('is_email_verified')->default(false);
            $table->string('status')->default('inactive');
            $table->timestamps();
            $table->string('uuid')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
