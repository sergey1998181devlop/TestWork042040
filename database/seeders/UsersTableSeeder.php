<?php

namespace Database\Seeders;

//use DB;
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
        $data = [
            //bcrypt - хэш пароля
            [
                'name' => 'Автор не известен',
                'email' => 'author_unknown@g.g',
                'password' => bcrypt(str_random(16))
            ],
            [
                'name' => 'Автор',
                'email' => 'author@g.g',
                'password' => bcrypt('123123')
            ],
        ];
        \DB::table('users')->insert($data);
    }
}
