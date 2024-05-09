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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birthdate');
            $table->char('gender', 1);
            $table->string('dojang');
            $table->string('type');
            $table->string('class');
            $table->string('category');
            $table->smallInteger('session');
            $table->enum('status', ['active', 'inactive'])->nullable();
            $table->smallInteger('ranking')->nullable();
            $table->timestamps();
        });
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('participant_id');
            $table->string('class_name');
            $table->string('referee');
            $table->decimal('accuration', 2, 2);
            $table->decimal('presentation', 2, 2);
            $table->timestamps();
        });
        Schema::create('calculations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('score_id');
            $table->decimal('sum_acuration', 2, 2);
            $table->decimal('sum_presentation', 2, 2);
            $table->decimal('total', 2, 2);
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
        Schema::dropIfExists('participants');
        Schema::dropIfExists('scores');
        Schema::dropIfExists('calculations');
    }
};
