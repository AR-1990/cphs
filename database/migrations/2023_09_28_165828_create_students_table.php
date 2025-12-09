<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name' , 50);
            $table->string('last_name' , 50);
            $table->string('email' , 50)->unique();
            $table->string('password' , 100);
            $table->string('phone' , 50);
            $table->string('gender' , 8);
            $table->integer('age')->nullable();
            $table->string('blood_group' , 10)->nullable();
            $table->string('height' , 50)->nullable();
            $table->string('weight' , 50)->nullable();
            $table->string('grade' , 50)->nullable();
            $table->string('bmi' , 50)->nullable();
            $table->integer('school_id');
            $table->string('guardian_name' , 50)->nullable();
            $table->string('guardian_email' , 50)->nullable();
            $table->string('guardian_phone' , 50)->nullable();
            $table->string('guardian_relation' , 50)->nullable();
            $table->integer('status')->default(1);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
