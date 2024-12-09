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
            $table->date('birthdate')->nullable();
            $table->char('gender', 1)->nullable();
            $table->string('dojang');
            $table->string('type');
            $table->string('class');
            $table->string('category');
            $table->smallInteger('session')->nullable();
            $table->enum('status', ['active', 'inactive'])->nullable();
            $table->smallInteger('ranking')->nullable();
            $table->timestamps();
        });
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('participant_id');
            $table->bigInteger('user_id');
            $table->string('class_name');
            $table->decimal('accuration', 5, 1);
            $table->decimal('presentation', 5, 1);
            $table->decimal('total', 5, 1);
            $table->timestamps();
        });
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('participant_id');
            $table->bigInteger('participant_id2');
            $table->bigInteger('participant_id3')->nullable();
            $table->string('name');
            $table->string('dojang');
            $table->string('type');
            $table->string('class');
            $table->string('category');
            $table->string('session')->nullable();
            $table->enum('status', ['active', 'inactive'])->nullable();
            $table->smallInteger('ranking')->nullable();
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
        Schema::dropIfExists('files');
        Schema::dropIfExists('teams');
    }
};
