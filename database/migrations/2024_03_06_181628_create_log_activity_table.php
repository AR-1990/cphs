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
        Schema::create('log_activity', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('check_in_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            // $table->timestamp('check_out_time')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('check_out_time')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('deleted')->default(0)->comment('0=not deleted,1=deleted');

            $table->string('subject')->nullable();
            $table->string('url')->nullable();
            $table->string('method')->nullable();
            $table->string('ip')->nullable();
            $table->string('agent')->nullable();
            $table->longText('location_details')->nullable();
            $table->integer('created_by')->default(0);
$table->integer('updated_by')->default(0);

            
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
        Schema::dropIfExists('log_activity');
    }
};
