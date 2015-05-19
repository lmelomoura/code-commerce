<?php
/**
 * Created by PhpStorm.
 * User: lmoura
 * Date: 15/05/2015
 * Time: 15:57
 */

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use CodeCommerce\Product;
use Faker\Factory as Faker;


class ProductTableSeeder extends Seeder{


    public function run()
    {
        $faker = Faker::create('pt_BR');
        $faker->locale('pt_BR');
        DB::table('products')->truncate();

        foreach(range(1,15) as $i){
            Product::Create([
                'name' => $faker->word(),
                'description' => $faker->sentence(),
                'price' => $faker->randomFloat() ,
                'featured' => $faker->boolean($chanceOfGettingTrue = 15),
                'recommended' => $faker->boolean($chanceOfGettingTrue = 10)
            ]);
        }
    }
}