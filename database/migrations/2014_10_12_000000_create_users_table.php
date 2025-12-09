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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname' , 50);
            $table->string('email' , 50)->unique();
            $table->string('phone' , 50);
            $table->string('address' , 500)->nullable();
            $table->integer('age');
            $table->string('gender' , 8)->nullable();
            $table->string('id_card_no' , 50)->nullable();
            $table->string('password' , 100);
            $table->integer('status')->default(1);
            $table->integer('role')->default(2);

            $table->integer('designation')->default(0)->nullable()->comment('0=admin,1=doctor,2=Nutritionist,3=Psychologist ');

            $table->integer('school_id')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
