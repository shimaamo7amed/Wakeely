<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegalProfilesTable extends Migration
{
    public function up()
    {
        // ================== legal_profiles ==================
        Schema::create('legal_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lawyer_id')
                ->constrained('clients')
                ->onDelete('cascade');

            $table->foreignId('bar_association_id')
                ->constrained('bar_association_degrees')
                ->onDelete('cascade');

            $table->string('registration_number');
            $table->date('registration_date');

            $table->foreignId('sub_associations_id')
                ->constrained('sub_associations')
                ->onDelete('cascade');

            $table->foreignId('experience_id')
                ->constrained('years_of_experience')
                ->onDelete('cascade');
            

            // الأسعار
            $table->decimal('consultation_price', 8, 2);

            // summary
            $table->text('summary');

            $table->timestamps();
        });

        // ================== qualifications ==================
        Schema::create('legal_qualifications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('legal_profile_id')
                ->constrained('legal_profiles')
                ->onDelete('cascade');

            $table->foreignId('degree_type_id')
                ->constrained('degree_types')
                ->onDelete('cascade');

            $table->foreignId('university_id')
                ->constrained('universities')
                ->onDelete('cascade');

            $table->year('year');

            $table->timestamps();
        });

        // ================== work areas pivot ==================
        Schema::create('legal_profile_work_area', function (Blueprint $table) {
            $table->id();

            $table->foreignId('legal_profile_id')
                ->constrained('legal_profiles')
                ->onDelete('cascade');

            $table->foreignId('governorate_id')
                ->constrained('governorates')
                ->onDelete('cascade');
        });

        // ================== expertise pivot ==================
        Schema::create('legal_profile_expertise', function (Blueprint $table) {
            $table->id();

            $table->foreignId('legal_profile_id')
                ->constrained('legal_profiles')
                ->onDelete('cascade');

            $table->foreignId('expertise_id')
                ->constrained('areas_of_practice')
                ->onDelete('cascade');
        });

         // ================== languages pivot ==================
        Schema::create('legal_profile_language', function (Blueprint $table) {
            $table->id();

            $table->foreignId('legal_profile_id')
                ->constrained('legal_profiles')
                ->onDelete('cascade');

            $table->foreignId('language_id')
                ->constrained('languages')
                ->onDelete('cascade');
        });


        // ================== card_id ==================
        Schema::create('card_id', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lawyer_id')
                ->constrained('clients')
                ->cascadeOnDelete();

            $table->string('front_id_card')->nullable();
            $table->string('back_id_card')->nullable();

            $table->timestamps();
        });

        // ================== legal_card ==================
        Schema::create('legal_card', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lawyer_id')
                ->constrained('clients')
                ->cascadeOnDelete();

            $table->string('front_legal_card')->nullable();
            $table->string('back_legal_card')->nullable();

            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('legal_profile_expertise');
        Schema::dropIfExists('legal_profile_work_area');
        Schema::dropIfExists('legal_profile_language');
        Schema::dropIfExists('legal_qualifications');
        Schema::dropIfExists('legal_profiles');
        Schema::dropIfExists('card_id');
        Schema::dropIfExists('legal_card');

        
    }
}
