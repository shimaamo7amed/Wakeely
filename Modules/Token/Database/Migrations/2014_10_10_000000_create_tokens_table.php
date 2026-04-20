<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration
{
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->integer('point')->default(0);
            $table->decimal('price', 10, 2)->default(0);
            $table->timestamps();
        });
        
            Schema::create('client_tokens', function (Blueprint $table) {
                $table->id();
                $table->foreignId('lawyer_id')->constrained('clients')->cascadeOnDelete();

                $table->integer('balance')->default(0);

                $table->timestamp('free_expires_at')->nullable(); // للمجاني
                $table->integer('free_balance')->default(0); // المجاني بس

                $table->timestamps();
            });

    }

    public function down()
    {
        Schema::dropIfExists('client_tokens');
        Schema::dropIfExists('tokens');
    }
}
