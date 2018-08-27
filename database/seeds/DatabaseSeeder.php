<?php

// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call(PermissionsSeed::class);
		$this->call(settingsSeeder::class);

		DB::table('gender')->insert([
			'value' => 'male',
		]);

		DB::table('gender')->insert([
			'value' => 'female',
		]);

		// Admin User
		DB::table('users')->insert([
			'email' => 'admin@admin.com',
			'password' => '$2a$04$RWYuMhFxZSplOxJYFwCzx.B/RHYZ8FDknEA25GQMeQ/vHK4FaWQd.',
			'username' => 'admin',
			'clan_id' => '0',
			'experiencepoints' => '0',
			'gender_id' => '1',
			'confirmed' => '1',
			'locked' => '0',
		]);

		DB::table('roles')->insert([
			'name' => 'admin' ,
			'guard_name' => 'web',
		]);
		DB::table('roles')->insert([
			'name' => 'member' ,
			'guard_name' => 'web',
		]);

		DB::table('roles')->insert([
			'name' => 'user',
			'guard_name' => 'web',
		]);

		DB::table('role_has_permissions')->insert([
			'permission_id' => '1' ,
			'role_id' => '1',
		]);

		DB::table('role_has_permissions')->insert([
			'permission_id' => '2' ,
			'role_id' => '1',
		]);

		DB::table('role_has_permissions')->insert([
			'permission_id' => '3' ,
			'role_id' => '1',
		]);

		DB::table('role_has_permissions')->insert([
			'permission_id' => '4' ,
			'role_id' => '1',
		]);

		DB::table('role_has_permissions')->insert([
			'permission_id' => '5' ,
			'role_id' => '1',
		]);

		DB::table('role_has_permissions')->insert([
			'permission_id' => '6' ,
			'role_id' => '1',
		]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => '8' ,
			'role_id' => '1',
		]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => '9' ,
			'role_id' => '1',
		]);

		DB::table('role_has_permissions')->insert([
			'permission_id' => '10' ,
			'role_id' => '1',
		]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => '11' ,
			'role_id' => '1',
		]);

				DB::table('role_has_permissions')->insert([
			'permission_id' => '2' ,
			'role_id' => '2',
		]);

		DB::table('model_has_roles')->insert([
			'role_id' => '1' ,
			'model_id' => '1',
			'model_type' => 'App\User',
		]);


		DB::table('forum')->insert([
			'title' => 'Rofl-Forum',
		]);


		DB::table('news')->insert([
			'title' => 'Start News',
			'content' => 'These are the Start News',
			'status' => '1',
			'comments' => '1',
			'orderNumber' => '1',
			'release_time' => '2018-01-01 00:00:00',
			'close_time' => '2018-01-01 00:00:00',
			'user_id' => '1',
		]);


		DB::table('articels')->insert([
			'author_id' => '1',
			'title' => 'Test Articel',
			'content' => 'These is the Start Articel',
			'active' => '1',
			'commentary' => '1',
			'release_time' => '2018-01-01 00:00:00',
			'orderNumber' => '1',
			'hits' => '0',
			'likes' => '0',
			'dislikes' => '0',
		]);

		/*Forum*/
		DB::table('forum')->insert([
			'title' => 'Ro.Fl. - Crew',
		]);

		DB::table('forumCategories')->insert([
			'title' => 'Ro.Fl. e.V. Intern',
			'description' => 'Ro.Fl. e.V. Intern',
			'active' => '1',
			'order' => '1',
			'forum_id' => '1',
			'intern' => '1',
		]);

		DB::table('forumCategories')->insert([
			'title' => 'Ro.Fl.-LAN 5',
			'description' => 'Ro.Fl.-LAN 5',
			'active' => '1',
			'order' => '2',
			'forum_id' => '1',
		]);
		DB::table('forumCategories')->insert([
			'title' => 'Ro.Fl. e.V.',
			'description' => 'Ro.Fl. e.V.',
			'active' => '1',
			'order' => '3',
			'forum_id' => '1',
		]);
		DB::table('forumCategories')->insert([
			'title' => 'Technik | Games & More',
			'description' => 'Technik | Games & More',
			'active' => '1',
			'order' => '4',
			'forum_id' => '1',
		]);
		DB::table('forumCategories')->insert([
			'title' => 'Off-Topic',
			'description' => 'Off-Topic',
			'active' => '1',
			'order' => '5',
			'forum_id' => '1',
		]);

		DB::table('forumCategories')->insert([
			'title' => 'Archiv',
			'description' => 'Archivierung',
			'active' => '0',
			'order' => '6',
			'forum_id' => '1',
		]);

		/*Forum Subcategorien*/
		DB::table('forumSubCategories')->insert([
			'title' => 'Intern Wichtig',
			'description' => 'Planung Interne Event',
			'active' => '1',
			'order' => '1',
			'cat_id' => '1',
		]);

		DB::table('forumSubCategories')->insert([
			'title' => 'Intern',
			'description' => 'Diskussionen',
			'active' => '1',
			'order' => '2',
			'cat_id' => '1',
		]);

		DB::table('forumSubCategories')->insert([
			'title' => 'Vorstand',
			'description' => 'Diskussionen Vorstand',
			'active' => '1',
			'order' => '3',
			'cat_id' => '1',
		]);


		DB::table('forumSubCategories')->insert([
			'title' => 'Gestaltet mit',
			'description' => 'Gestaltet mit und bringt eure Ideen ein',
			'active' => '1',
			'order' => '1',
			'cat_id' => '2',
		]);

		DB::table('forumSubCategories')->insert([
			'title' => 'Turniere',
			'description' => '',
			'active' => '1',
			'order' => '2',
			'cat_id' => '2',
		]);

		DB::table('forumSubCategories')->insert([
			'title' => 'Sitzplan',
			'description' => '',
			'active' => '1',
			'order' => '3',
			'cat_id' => '2',
		]);



		DB::table('forumSubCategories')->insert([
			'title' => 'Mitfahrgelegenheit',
			'description' => '',
			'active' => '1',
			'order' => '4',
			'cat_id' => '2',
		]);

		DB::table('forumSubCategories')->insert([
			'title' => 'Team - Spielersuche',
			'description' => '',
			'active' => '1',
			'order' => '5',
			'cat_id' => '2',
		]);

		DB::table('forumSubCategories')->insert([
			'title' => 'Allgemeines',
			'description' => 'Allgemeines',
			'active' => '1',
			'order' => '1',
			'cat_id' => '3',
		]);

		DB::table('forumSubCategories')->insert([
			'title' => 'News',
			'description' => 'Interne News',
			'active' => '1',
			'order' => '2',
			'cat_id' => '3',
		]);

		DB::table('forumSubCategories')->insert([
			'title' => 'Ideen',
			'description' => 'Ideen rund um und zu dem Verein',
			'active' => '1',
			'order' => '3',
			'cat_id' => '3',
		]);


		DB::table('forumSubCategories')->insert([
			'title' => 'Technik',
			'description' => 'Hilfe, Interessantes & More',
			'active' => '1',
			'order' => '1',
			'cat_id' => '4',
		]);

		DB::table('forumSubCategories')->insert([
			'title' => 'Games',
			'description' => 'Games',
			'active' => '1',
			'order' => '2',
			'cat_id' => '4',
		]);

		DB::table('forumSubCategories')->insert([
			'title' => 'Spielplatz',
			'description' => 'Spielplatz',
			'active' => '1',
			'order' => '2',
			'cat_id' => '5',
		]);


		/*Forum END*/

		/*Sponsoren*/
		// DB::table('sponsoren')->insert([
		// 	'name' => 'Sponsor1',
		// 	'description' => 'Sponsor # 1',
		// 	'website' => 'http://www.google.de',
		// 	'activ' => '1',
		// ]);

		/*Partner*/
		// DB::table('partner')->insert([
		// 	'name' => 'Partner1',
		// 	'description' => 'Partner # 1',
		// 	'website' => 'http://www.google.de',
		// 	'activ' => '1',
		// ]);



		/*Issue List*/
		// DB::table('issueLists')->insert([
		// 	'url' => 'Startsite',
		// 	'description' => 'Test Issue',
		// 	'user_id' => '1',
		// ]);



		/*Membership*/
		DB::table('membership')->insert([
			'value' => 'Member',
		]);

		DB::table('membership')->insert([
			'value' => 'Vorstand',
		]);

		DB::table('membership')->insert([
			'value' => 'User',
		]);

		/*Games*/
		DB::table('games')->insert([
			'name' => 'Testgame',
			'description' =>  'test game',
		]);

		/*EVENT*/
		// DB::table('event')->insert([
		// 	'author_id' => '1',
		// 	'name' => 'Event1',
		// 	'active' => '1',
		// 	'intern' => '0',
		// 	'allowedUser' => '120',
		// 	'event_start' => '2018-01-01 00:00:00',
		// 	'event_end' => '2018-01-01 00:00:00',
		// 	'signup_start' => '2018-01-01 00:00:00',
		// 	'signup_end' => '2018-01-01 00:00:00',
		// 	'seatReserve_start' => '2018-01-01 00:00:00',
		// 	'seatReserve_end' => '2018-01-01 00:00:00',
		// ]);

		// DB::table('tickets')->insert([
		// 	'name' => 'Test Ticket1',
		// 	'description' => 'Test Ticket # 1 Desc',
		// 	'start_time' => '2018-01-01 00:00:00',
		// 	'end_time' => '2018-01-01 00:00:00',
		// 	'event_id' => '1',
		// 	'prices' => '12',
		// 	'active' => '1',
		// ]);

		// DB::table('event_location')->insert([
		// 	'name' => 'Location1',
		// 	'waydescription' => 'Way # 1',
		// 	'description' => 'Descript # 1',
		// 	'street' => 'Street # 1',
		// 	'city' => 'city # 1',
		// 	'zip' => 'zip # 1',
		// 	'country' => 'country # 1',
		// ]);


		// DB::table('event_sponsors')->insert([
		// 	'name' => 'Event Sponsor1',
		// 	'homepage' => 'www.www.www',
		// 	'text' => 'Event Sponsor # 1',
		// 	'email' => 'Event Sponsor # 1@sponsor.de',
		// 	'event_id' => '1',
		// ]);



		DB::table('event_userpayMethod')->insert([
			'name' => 'Bar',
		]);
		DB::table('event_userpayMethod')->insert([
			'name' => 'Paypal',
		]);
		DB::table('event_userpayMethod')->insert([
			'name' => 'Überweisung',
		]);


		// DB::table('event_users')->insert([
		// 	'event_id' => '1',
		// 	'user_id' => '1',
		// 	'payment_id' => '1',
		// 	'pay_date' => '2018-01-01 00:00:00',
		// 	'ticket_id' => '1',
		// 	'arrived' => '0',
		// 	'paid' => '1',
		// ]);

		DB::table('event_tournament_type')->insert([
			'name' => 'Single Elimination',
		]);

		DB::table('event_tournament_type')->insert([
			'name' => 'Double Elimination',
		]);

		DB::table('event_tournament_type')->insert([
			'name' => 'Season',
		]);

		// // DB::table('event_tournament')->insert([
		// // 	'event_id' => '1',
		// // 	'games_id' => '1',
		// // 	'name' => 'Tournament #1',
		// // 	'start' => '2018-01-01 00:00:00',
		// // 	'end' => '2018-01-01 00:00:00',
		// // 	'maxTeams' => '6',
		// // 	'playerPerTeam' => '2',
		// // 	'watcher1_id' => '1',
		// // 	'type_id' => '1',
		// // ]);

		// DB::table('event_tournament_teams')->insert([
		// 	'tournament_id' => '1',
		// 	'name' => 'Team # 1',
		// 	'win' =>  '0',
		// 	'lose' => '0',
		// ]);

		// DB::table('event_tournament_player')->insert([
		// 	'team_id' => '1',
		// 	'player_id' => '1',
		// ]);

		DB::table('event_sitzplatzstatus')->insert([
			'name' => 'frei',
		]);

		DB::table('event_sitzplatzstatus')->insert([
			'name' => 'reserviert',
		]);

		DB::table('event_sitzplatzstatus')->insert([
			'name' => 'belegt',
		]);
	}
}
