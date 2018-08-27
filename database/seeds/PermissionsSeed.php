<?php


// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
// DO NOT CHANGE OR YOU WILL BE DOOMED
use Illuminate\Database\Seeder;

class PermissionsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('permissions')->insert([
          'name' => 'Administer roles & permissions',
          'guard_name' => 'web',
      ]);
        
        DB::table('permissions')->insert([
            'name' => 'Vereinsmitglied',
            'guard_name' => 'web',
        ]);

        DB::table('permissions')->insert([
          'name' => 'News-Admin',
          'guard_name' => 'web',
      ]);

        DB::table('permissions')->insert([
          'name' => 'Articel-Admin',
          'guard_name' => 'web',
      ]);

        DB::table('permissions')->insert([
          'name' => 'User-Admin',
          'guard_name' => 'web',
      ]);

        DB::table('permissions')->insert([
          'name' => 'Layout-Admin',
          'guard_name' => 'web',
      ]);

        DB::table('permissions')->insert([
          'name' => 'Calendar-Admin',
          'guard_name' => 'web',
      ]);

        DB::table('permissions')->insert([
          'name' => 'Mailbox-Admin',
          'guard_name' => 'web',
      ]);

        DB::table('permissions')->insert([
          'name' => 'Pages-Admin',
          'guard_name' => 'web',
      ]);


        DB::table('permissions')->insert([
          'name' => 'Forum-Admin',
          'guard_name' => 'web',
      ]);

        DB::table('permissions')->insert([
          'name' => 'Event-Admin',
          'guard_name' => 'web',
      ]);

        DB::table('permissions')->insert([
          'name' => 'Event-Intern',
          'guard_name' => 'web',
      ]);

        DB::table('permissions')->insert([
          'name' => 'Active-Events',
          'guard_name' => 'web',
      ]);


        DB::table('permissions')->insert([
          'name' => 'Issue-Admin',
          'guard_name' => 'web',
      ]);
        DB::table('permissions')->insert([
          'name' => 'Settings-Admin',
          'guard_name' => 'web',
      ]);
        DB::table('permissions')->insert([
          'name' => 'Sponsoren-Admin',
          'guard_name' => 'web',
      ]);

        DB::table('permissions')->insert([
          'name' => 'Tickets-Admin',
          'guard_name' => 'web',
      ]);

        DB::table('permissions')->insert([
          'name' => 'Partner-Admin',
          'guard_name' => 'web',
      ]);

        DB::table('permissions')->insert([
          'name' => 'Media-Admin',
          'guard_name' => 'web',
      ]);

        DB::table('permissions')->insert([
          'name' => 'Team-Admin',
          'guard_name' => 'web',
      ]);

        DB::table('permissions')->insert([
          'name' => 'Teamspeak-Admin',
          'guard_name' => 'web',
      ]);

        DB::table('permissions')->insert([
          'name' => 'Esports-Admin',
          'guard_name' => 'web',
      ]);


        DB::table('permissions')->insert([
          'name' => 'Presse-Admin',
          'guard_name' => 'web',
      ]);


        DB::table('permissions')->insert([
          'name' => 'Verein-Admin',
          'guard_name' => 'web',
      ]);


        DB::table('permissions')->insert([
          'name' => 'Email',
          'guard_name' => 'web',
      ]);


    }
}
