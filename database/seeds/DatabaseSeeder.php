<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'alt@support.com',
            'avatar' => '111',
            'password' => bcrypt('secret'),
        ]);

        DB::table('site_terms')->insert([
            'terms_use' => 'here is terms uu',
            'privacy_policy' => 'here is privacy policy',
            'about_us' => 'about us',
            'how_it_work' => 'how_it_work',
        ]);
    }
}
