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
        Schema::create('labs', function (Blueprint $table) {
        
            $table->id(); // Primary key
            $table->unsignedBigInteger('form_entry_id'); // Foreign key to form_entries

            $table->string('title'); // Title of the form
            $table->text('document_names'); // JSON field to store multiple document names

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
        Schema::dropIfExists('labs');
    }
};
