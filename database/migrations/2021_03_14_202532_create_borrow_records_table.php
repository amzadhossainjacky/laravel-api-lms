<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('br_bookId');
            $table->unsignedBigInteger('br_userId');
            $table->string('br_releaseDate')->nullable();
            $table->string('br_dueDate')->nullable();
            $table->string('br_dueStatus')->default('0');
            $table->timestamps();
            $table->foreign('br_userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('br_bookId')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrow_records');
    }
}
