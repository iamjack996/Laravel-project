<?php

use Illuminate\Database\Seeder;
use App\Model2\users;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users =[
        [
            'id' => '30',
            'name' => 'Jack',
            'email' => 'iamjack996@gmail.com',
            'password' => Hash::make('futura996'),
            'isAdmin' => '2'
        ],
        [
            'id' => '51',
            'name' => 'FUTURA_TEAM',
            'email' => 'futura.noreply@gmail.com',
            'password' => Hash::make('admin2016futura'),
            'isAdmin' => '1'
        ],
        [
            'id' => '40',
            'name' => 'Amy',
            'email' => 'amy@gmail.com',
            'password' => Hash::make('123456'),
            'isAdmin' => '0'
        ],
      ];

      DB::table('users')->delete();
    foreach ($users as $user){
        users::create($user);
        }
    }
}
