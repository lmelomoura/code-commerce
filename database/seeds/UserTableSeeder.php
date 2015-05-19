<?php
/**
 * Created by PhpStorm.
 * User: lmoura
 * Date: 15/05/2015
 * Time: 15:57
 */

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use CodeCommerce\User;
use Faker\Factory as Faker;


class UserTableSeeder extends Seeder{


    public function run()
    {
        $faker = Faker::create('pt_BR');
        DB::table('users')->truncate();

        foreach(range(1,15) as $i){
            User::Create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => $faker->sha256(),
                'remember_token' => $faker->uuid()
            ]);
        }
    }
}