<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->references('id')->on('questions')->onUpdate('cascade')->onDelete('cascade');
            $table->text('result_value')->nullable();
            $table->integer('min_value')->default(0);
            $table->integer('max_value')->default(0);
            $table->integer('result_numrate');
            $table->text('result_textrate');
            $table->integer('result_status');
            $table->integer('result_statusvalue')->default('0');
            $table->string('pdf_text')->default(' ');
            $table->integer('pdf_text_status')->default('0');
            $table->integer('status_for_group')->default('0');
            $table->integer('status_for_evaluation')->default('0');


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
        Schema::dropIfExists('results');
    }
}
