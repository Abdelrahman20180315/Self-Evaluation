<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');;
            $table->integer('total_score');
            $table->foreignId('program_id')->references('id')->on('programs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('question_id')->references('id')->on('questions')->onUpdate('cascade')->onDelete('cascade');;
            $table->integer('evaluate_id');
            $table->string('result_value')->default(' ');
            $table->integer('evalute_num')->default('0');
            $table->string('evalute_text')->default(' ');
            $table->string('pdf_text')->default(' ');
            $table->string('pdf_path')->default(' ');
            $table->integer('pdf_text_status')->default('0');
            $table->integer('show_user_results')->default('0');
            $table->integer('show_user_pdf')->default('0');
            $table->string('organization_status')->default(' ');
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
        Schema::dropIfExists('evaluations');
    }
}
