<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bio_data', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('guardianname');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->unsignedBigInteger('school');
            $table->unsignedBigInteger('city');
            $table->unsignedBigInteger('area');
            $table->date('dob');
            $table->integer('age');
            $table->string('Emergency_Contact_Number');
            $table->string('Gr_Number');
            $table->string('Any_Known_Medical_Condition');
            $table->string('Address');
            $table->string('Blood_group');
            $table->text('bio_data_comment');

            // Other fields
            $table->tinyInteger('status')->default(1)->comment("0=inactive,1=active");
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->integer('deleted')->default(0)->comment('0=not deleted,1=deleted');
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
        Schema::dropIfExists('bio_data');
    }
};
