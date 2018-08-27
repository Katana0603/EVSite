<?php

// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
use Illuminate\Database\Seeder;

class settingsSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('settings')->insert([
			'title' => 'Site Title',
			'description' => 'Titel der Seite',
			'status' => '1',
			'value' => 'TestPage',
		]);

	}
}
