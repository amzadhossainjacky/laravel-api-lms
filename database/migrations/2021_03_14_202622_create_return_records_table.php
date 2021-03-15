<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('re_bookId');
            $table->unsignedBigInteger('re_userId');
            $table->unsignedBigInteger('re_adminId');
            $table->string('re_returnDate')->nullable();
            $table->string('re_returnStatus')->default('0');
            $table->string('re_fine')->default('0');
            $table->timestamps();
            $table->foreign('re_userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('re_bookId')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('re_adminId')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('return_records');
    }
}
