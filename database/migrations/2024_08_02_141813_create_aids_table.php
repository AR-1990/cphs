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
        Schema::create('aids', function (Blueprint $table) {
            $table->id();

            $table->id();

            // Nullable fields
            $table->unsignedBigInteger('DoctorID')->nullable();
            $table->text('Reason')->nullable();
            $table->text('Aids')->nullable();
            $table->unsignedBigInteger('form_entry_id')->nullable();

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
        Schema::dropIfExists('aids');
    }
};
