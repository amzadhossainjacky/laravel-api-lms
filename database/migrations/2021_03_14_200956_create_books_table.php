<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bk_adminId');
            $table->string('bk_category')->nullable();
            $table->text('bk_title')->nullable();
            $table->string('bk_author')->nullable();
            $table->string('bk_edition')->nullable();
            $table->string('bk_publisher')->nullable();
            $table->string('bk_copies')->nullable();
            $table->string('bk_cost')->nullable();
            $table->string('bk_vendor')->nullable();
            $table->string('bk_image')->nullable();
            $table->timestamps();
            $table->foreign('bk_adminId')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
