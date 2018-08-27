<?php

// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('users', function (Blueprint $table) {
    		$table->increments('id');
    		$table->string('email')->unique();
    		$table->string('avatar')->nullable()->default('user/default.png');
    		$table->string('password');
    		$table->string('username')->default('Username')->unique();
    		$table->string('firstname')->nullable();
    		$table->string('name')->nullable();
    		$table->date('birthdate')->nullable();
    		$table->integer('gender_id')->nullable();
    		$table->string('street')->nullable();
    		$table->string('zip')->nullable();
    		$table->string('city')->nullable();
    		$table->string('country')->nullable();
    		$table->integer('clan_id')->nullable()->default(0);
    		$table->string('phone')->nullable();
    		$table->string('handy')->nullable();
    		$table->text('signature', 65535)->nullable();
    		$table->boolean('locked')->default(1);
    		$table->string('confirmation_code')->default('12345');
    		$table->boolean('confirmed')->default(0);
    		$table->bigInteger('experiencepoints')->nullable()->default(0);
    		$table->rememberToken();
    		$table->timestamps();
    		$table->softDeletes();
    	});

    	Schema::create('level', function(Blueprint $table)
    	{
    		$table->increments('id');
    		$table->string('description')->nullable();
    		$table->bigInteger('from')->nullable();
    		$table->bigInteger('till')->nullable();
    		$table->timestamps();
    		$table->softDeletes();
    	});



    	Schema::create('gender', function(Blueprint $table)
    	{
    		$table->increments('id');
    		$table->string('value');
    		$table->timestamps();
    	});

    	Schema::create('clan', function(Blueprint $table)
    	{
    		$table->increments('id');
    		$table->string('name')->unique();
    		$table->string('website')->nullable();
    		$table->string('avatar')->nullable();
    		$table->timestamps();
    		$table->softDeletes();
    	});

    	Schema::create('users_activations', function (Blueprint $table) {
    		$table->integer('user_id')->unsigned();
    		$table->string('token')->index();
    		$table->timestamp('created_at');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::dropIfExists('users_activations');
    	Schema::dropIfExists('gender');
    	Schema::dropIfExists('level');
    	Schema::dropIfExists('clan');
    	Schema::dropIfExists('users');
    }
}
