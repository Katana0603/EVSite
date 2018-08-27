<?php

// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitalMigration extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		/*News*/
		Schema::create('news', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 250);
			$table->text('content', 65535);
			$table->boolean('status', 1)->nullable();
			$table->boolean('comments', 1)->nullable();
			$table->integer('orderNumber')->nullable();
			$table->dateTime('release_time')->nullable();
			$table->dateTime('close_time')->nullable();
			$table->integer('likes')->default(0);
			$table->integer('dislikes')->default(0);
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->softDeletes();
		});

		Schema::create('news_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('news_id')->unsigned();
			$table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->text('content');
			$table->timestamps();
			$table->softDeletes();
		});
		/*News End*/
		/*Articel*/
		Schema::create('articels', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('author_id')->unsigned();
			$table->foreign('author_id')->references('id')->on('users');
			$table->string('title', 250)->nullable();
			$table->text('content', 65535)->nullable();
			$table->boolean('active', 1)->nullable();
			$table->boolean('commentary', 1)->nullable();
			$table->dateTime('release_time')->nullable();
			$table->integer('orderNumber')->nullable();
			$table->integer('hits')->nullable();
			$table->integer('likes')->nullable();
			$table->integer('dislikes')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::create('articel_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->nullable()->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->integer('articel_id')->nullable()->unsigned();
			$table->foreign('articel_id')->references('id')->on('articels')->onDelete('cascade');
			$table->text('content');
			$table->timestamps();
			$table->softDeletes();
		});
		/*Articel End*/
		/*Media*/
		Schema::create('media', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('file_name');
			$table->string('file_path');
			$table->string('disk');
			$table->nullableTimestamps();
		});
		/*Media End*/
		/*Forum*/
		Schema::create('forum', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::create('forumCategories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 250);
			$table->string('description', 250)->nullable();
			$table->boolean('active', 1)->nullable();
			$table->boolean('intern', 1)->default(0);
			$table->integer('order')->nullable();
			$table->timestamps();
			$table->integer('forum_id')->unsigned();
			$table->foreign('forum_id')->references('id')->on('forum');
			$table->softDeletes();

		});
		Schema::create('forumSubCategories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cat_id')->unsigned();
			$table->foreign('cat_id')->references('id')->on('forumCategories');
			$table->string('title', 250)->nullable();
			$table->string('description', 250)->nullable();
			$table->boolean('active', 1)->nullable();
			$table->integer('order')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::create('forumThreads', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('author_id')->unsigned();
			$table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
			$table->integer('subcat_id')->unsigned();
			$table->foreign('subcat_id')->references('id')->on('forumSubCategories');
			$table->string('title', 250)->nullable();
			$table->text('content', 65535)->nullable();
			$table->boolean('active', 1)->nullable();
			$table->integer('order')->nullable();
			$table->integer('hits')->nullable();
			$table->integer('likes')->nullable();
			$table->integer('dislikes')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::create('forumPosts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('author_id')->unsigned();
			$table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
			$table->integer('edit_id')->unsigned();
			$table->foreign('edit_id')->references('id')->on('users')->onDelete('cascade');
			$table->integer('thread_id')->unsigned();
			$table->foreign('thread_id')->references('id')->on('forumThreads')->onDelete('cascade');
			$table->text('content', 65535)->nullable();
			$table->boolean('active', 1)->nullable();
			$table->integer('order')->nullable();
			$table->integer('hits')->nullable();
			$table->integer('likes')->nullable();
			$table->integer('dislikes')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		/* Forum End*/

		/*Sponsoren*/
		Schema::create('sponsoren', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 250);
			$table->text('description', 65535)->nullable();
			$table->string('website')->nullable();
			$table->boolean('activ')->nullable();
			$table->text('media_path')->nullable();
			$table->integer('media_id')->unsigned()->nullable();
			$table->foreign('media_id')->references('id')->on('media');
			$table->timestamps();
			$table->softDeletes();
		});
		/*Sponsoren End*/
		/*Partner*/
		Schema::create('partner', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 250);
			$table->text('description', 65535);
			$table->string('website')->nullable();
			$table->text('media_path')->nullable();
			$table->integer('media_id')->unsigned()->nullable();
			$table->foreign('media_id')->references('id')->on('media');
			$table->timestamps();
			$table->softDeletes();
			$table->boolean('activ', 1)->nullable();
		});
		/*Partner End*/
		/*Issue List*/
		Schema::create('issueLists', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('url', 250)->nullable();
			$table->text('description', 65535)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('user_id')->nullable()->unsigned();
			$table->foreign('user_id')->references('id')->on('users');

		});    
		/*Issue List End*/
		/*Membership*/
		Schema::create('membership', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('value', 250)->nullable();
			$table->timestamps();
		});
		/*Membership End*/
		/*Games*/
		Schema::create('games', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->text('description');
			$table->text('media_path')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		/*Games End*/
		/*Settings*/
		Schema::create('settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 250);
			$table->string('description');
			$table->boolean('status',1)->nullable();
			$table->string('value')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		/*Settings End*/
		/*PM*/
		Schema::create('pm', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('subject');
			$table->integer('user1')->unsigned();
			$table->foreign('user1')->references('id')->on('users');
			$table->integer('user2')->unsigned();
			$table->foreign('user2')->references('id')->on('users');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('pm_follow', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pm_id')->unsigned();
			$table->foreign('pm_id')->references('id')->on('pm');
			$table->integer('fromUser')->unsigned();
			$table->foreign('fromUser')->references('id')->on('users');
			$table->integer('toUser')->unsigned();
			$table->foreign('toUser')->references('id')->on('users');
			$table->text('message');
			$table->boolean('read');
			$table->timestamps();
			$table->softDeletes();
		});
		/*PM End*/
		/*Event*/
		Schema::create('event', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('author_id')->unsigned();
			$table->foreign('author_id')->references('id')->on('users');
			$table->string('name', 250);
			$table->boolean('active',1)->nullable();
			$table->boolean('intern')->nullable();
			$table->integer('allowedUser');
			$table->dateTime('lastAccountCheck')->nullable();
			$table->dateTime('event_start')->nullable();
			$table->dateTime('event_end')->nullable();
			$table->dateTime('signup_start')->nullable();
			$table->dateTime('signup_end')->nullable();
			$table->dateTime('seatReserve_start')->nullable();
			$table->dateTime('seatReserve_end')->nullable();
			$table->integer('location_id')->nullable();
			$table->text('media_path')->nullable();
			$table->integer('media_id')->unsigned()->nullable();
			$table->foreign('media_id')->references('id')->on('media');
			$table->text('requirement')->nullable();
			$table->integer('minAge')->nullable();
			$table->integer('arrive_id')->unsigned()->nullable();
			$table->foreign('arrive_id')->references('id')->on('articels');
			$table->timestamps();
			$table->softDeletes();

		});

		Schema::create('tickets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable();
			$table->text('description')->nullable();
			$table->dateTime('start_time')->nullable();
			$table->dateTime('end_time')->nullable();
			$table->integer('event_id')->unsigned()->nullable();
			$table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
			$table->float('prices');
			$table->text('backgroundgraphic')->nullable();
			$table->text('uploadedTicketImage')->nullable();
			$table->boolean('active')->default(1);
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('event_location', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->text('waydescription');
			$table->text('description');
			$table->string('street')->nullable();
			$table->string('city')->nullable();
			$table->string('zip')->nullable();
			$table->string('country')->nullable();
			$table->string('longitude')->nullable();
			$table->string('latitude')->nullable();
			$table->text('media_path')->nullable();
			$table->integer('media_id')->unsigned()->nullable();
			$table->foreign('media_id')->references('id')->on('media');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('event_sponsors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('homepage')->nullable();
			$table->string('text')->nullable();
			$table->string('email')->nullable();
			$table->integer('event_id')->unsigned();
			$table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
			$table->text('media_path')->nullable();
			$table->integer('media_id')->unsigned()->nullable();
			$table->foreign('media_id')->references('id')->on('media');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('event_partner', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('homepage')->nullable();
			$table->string('text')->nullable();
			$table->string('email')->nullable();
			$table->integer('event_id')->unsigned();
			$table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
			$table->text('media_path')->nullable();
			$table->integer('media_id')->unsigned()->nullable();
			$table->foreign('media_id')->references('id')->on('media');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('event_userpayMethod', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
		});

		Schema::create('event_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('event_id')->unsigned();
			$table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->integer('payment_id')->unsigned()->nullable();
			$table->foreign('payment_id')->references('id')->on('event_userpayMethod')->onDelete('cascade');
			$table->dateTime('pay_date')->nullable();
			$table->integer('ticket_id')->unsigned()->nullable();
			$table->foreign('ticket_id')->references('id')->on('tickets');            
			$table->boolean('arrived',1)->nullable();
			$table->boolean('paid')->nullable()->default(0);
			$table->time('arrived_time')->nullable();
			$table->text('comment')->nullable();
			$table->timestamps();
			
			$table->softdeletes();
		});

		Schema::create('event_tournament_type', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('event_tournament', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('event_id')->unsigned();
			$table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
			$table->integer('games_id')->unsigned();
			$table->foreign('games_id')->references('id')->on('games')->onDelete('cascade');
			$table->string('name');
			$table->dateTime('start');
			$table->dateTime('end');
			$table->integer('maxTeams');
			$table->integer('playerPerTeam');
			$table->boolean('active')->default(1);
			$table->integer('watcher1_id')->unsigned();
			$table->foreign('watcher1_id')->references('id')->on('users');
			$table->integer('watcher2_id')->unsigned()->nullable();
			$table->foreign('watcher2_id')->references('id')->on('users');
			$table->integer('type_id')->unsigned();
			$table->foreign('type_id')->references('id')->on('event_tournament_type');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('event_tournament_teams', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tournament_id')->unsigned();
			$table->foreign('tournament_id')->references('id')->on('event_tournament')->onDelete('cascade');
			$table->string('name');
			$table->integer('win');
			$table->integer('lose');
			$table->timestamps();
			$table->softDeletes();
		});        

		Schema::create('event_tournament_player', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('team_id')->unsigned();
			$table->foreign('team_id')->references('id')->on('event_tournament_teams')->onDelete('cascade');
			$table->integer('player_id')->unsigned();
			$table->foreign('player_id')->references('id')->on('event_users')->onDelete('cascade');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('event_tournament_matches', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tournament_id')->unsigned();
			$table->foreign('tournament_id')->references('id')->on('event_tournament')->onDelete('cascade');
			$table->integer('number')->default(0);
			$table->integer('t1_id')->unsigned()->nullable();
			$table->foreign('t1_id')->references('id')->on('event_tournament_teams');
			$table->integer('t1_pre')->nullable();
			$table->integer('t2_id')->unsigned()->nullable();
			$table->foreign('t2_id')->references('id')->on('event_tournament_teams');
			$table->integer('t2_pre')->nullable();
			$table->integer('winner_id')->unsigned()->nullable();
			$table->foreign('winner_id')->references('id')->on('event_tournament_teams');
			$table->integer('round');
			$table->boolean('winBracket')->default(1);
			$table->integer('score_t1')->default(0);
			$table->integer('score_t2')->default(0);
			$table->datetime('starttime')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('event_sitzplan', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->boolean('active');
			$table->integer('event_id')->unsigned();
			$table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
			$table->text('media_path')->nullable();
			$table->integer('media_id')->unsigned()->nullable();
			$table->foreign('media_id')->references('id')->on('media');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('event_sitzplatzstatus', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('event_sitzplatz', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sitzplatzNr');
			$table->string('name');
			$table->integer('x')->nullable();
			$table->integer('y')->nullable();
			$table->integer('sitzplan_id')->unsigned();
			$table->foreign('sitzplan_id')->references('id')->on('event_sitzplan')->onDelete('cascade');
			$table->integer('eventuser_id')->unsigned()->nullable();
			$table->foreign('eventuser_id')->references('id')->on('event_users')->onDelete('cascade');
			$table->integer('status_id')->unsigned()->nullable();
			$table->foreign('status_id')->references('id')->on('event_sitzplatzstatus');
			$table->timestamps();
			$table->softDeletes();
		});
		/*Event End*/

		/*Team*/

		Schema::create('team_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('description');
			$table->timestamps();
			$table->softDeletes();
		});


		Schema::create('team', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->integer('teamCat_id')->unsigned();
			$table->foreign('teamCat_id')->references('id')->on('team_categories')->onDelete('cascade');
			$table->string('function');
			$table->string('description');
			$table->integer('orderNumber');
			$table->timestamps();
			$table->softDeletes();
		});
		/*Team End*/




		Schema::create('startupNews', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('text');
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

		Schema::dropIfExists('events');
		Schema::dropIfExists('startupNews');
		Schema::dropIfExists('team');
		Schema::dropIfExists('team_categories');
		Schema::dropIfExists('event_sitzplatz');
		Schema::dropIfExists('event_sitzplatzstatus');
		Schema::dropIfExists('event_sitzplan');
		Schema::dropIfExists('event_tournament_matches');
		Schema::dropIfExists('event_tournament_player');
		Schema::dropIfExists('event_tournament_teams');
		Schema::dropIfExists('event_tournament');
		Schema::dropIfExists('event_tournament_type');
		Schema::dropIfExists('event_users');
		Schema::dropIfExists('event_userpayMethod');
		Schema::dropIfExists('event_partner');
		Schema::dropIfExists('event_sponsors');
		Schema::dropIfExists('event_location');
		Schema::dropIfExists('tickets');
		Schema::dropIfExists('event');
		Schema::dropIfExists('pm_follow');
		Schema::dropIfExists('pm');
		Schema::dropIfExists('settings');
		Schema::dropIfExists('games');
		Schema::dropIfExists('membership');
		Schema::dropIfExists('issueLists');
		Schema::dropIfExists('partner');
		Schema::dropIfExists('sponsoren');
		Schema::dropIfExists('forumPosts');
		Schema::dropIfExists('forumThreads');
		Schema::dropIfExists('forumSubCategories');
		Schema::dropIfExists('forumCategories');
		Schema::dropIfExists('forum');
		Schema::dropIfExists('media');
		Schema::dropIfExists('articel_comments');
		Schema::dropIfExists('articels');
		Schema::dropIfExists('news_comments');
		Schema::dropIfExists('news');
	}
}
