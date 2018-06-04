<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
            'name' => 'Nom' .$i,
            'email' => 'email' .$i. '@fai.fr',
            'password' => bcrypt('password' .$i)
          ]);
        }
    }
}
