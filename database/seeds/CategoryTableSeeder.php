<?php
/**
 * Created by PhpStorm.
 * User: lmoura
 * Date: 15/05/2015
 * Time: 15:57
 */

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use CodeCommerce\Category;
use Faker\Factory as Faker;


class CategoryTableSeeder extends Seeder{


    public function run()
    {
        $faker = Faker::create();
        DB::table('categories')->truncate();

        foreach(range(1,15) as $i){
            Category::Create([
                'name' => $faker->word(),
                'description' => $faker->sentence()
            ]);
        }
    }
}