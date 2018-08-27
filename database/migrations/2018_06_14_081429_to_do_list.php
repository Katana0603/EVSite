<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ToDoList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toDoList', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('creationUser_id')->unsigned();
            $table->foreign('creationUser_id')->references('id')->on('users');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('role_id')->unsigned()->nullable();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('desc');
            $table->date('deadline');
            $table->Softdeletes();
            $table->timestamps();
        });


        Schema::create('calendar_events', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('creationUser_id')->unsigned();
            $table->foreign('creationUser_id')->references('id')->on('users');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');                 
            $table->integer('role_id')->unsigned()->nullable();
            $table->foreign('role_id')->references('id')->on('roles');  
            $table->boolean('all')->default(0);   
            $table->boolean('allDay')->default(0);   
            $table->string('subject');
            $table->text('desc');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->timestamps();
            $table->Softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {


        Schema::dropIfExists('calendar_events');
        Schema::dropIfExists('toDoList');
    }
}
