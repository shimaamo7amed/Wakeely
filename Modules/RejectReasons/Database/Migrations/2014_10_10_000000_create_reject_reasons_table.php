<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRejectReasonsTable extends Migration
{
    public function up()
    {
    Schema::create('reject_reasons', function (Blueprint $table) {
        $table->id();

        $table->string('key');
        $table->string('name_en');
        $table->string('name_ar');
        $table->boolean('has_input')->default(false);
        $table->timestamps();
    });


    Schema::create('lawyer_rejection_pivot', function (Blueprint $table) {
        $table->id();
        $table->foreignId('lawyer_id')->constrained('clients')->cascadeOnDelete();
        $table->foreignId('reject_reason_id')->constrained('reject_reasons')->cascadeOnDelete();
        $table->string('custom_comment')->nullable();

        $table->timestamps();
    });

}


    public function down()
    {
        Schema::dropIfExists('reject_reasons');
    }
}
