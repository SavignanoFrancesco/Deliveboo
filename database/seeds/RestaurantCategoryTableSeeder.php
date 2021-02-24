<?php

use Illuminate\Database\Seeder;
use App\RestaurantCategory;
use Faker\Generator as Faker;

class RestaurantCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = array_values(config('restaurant_categories.categories'));
        $categories_values = array_keys(config('restaurant_categories.categories'));

        for ($i = 0; $i < count($categories); $i++) {
            $new_rest = new RestaurantCategory();
            $new_rest->name = $categories_values[$i];
            $new_rest->cover = $categories[$i];

            // $test = RestaurantCategory::where('name', $new_rest->name)->first();
            // while ($test) {
            //     $new_rest->name = $faker->words(1, true);
            //     $test = RestaurantCategory::where('name', $new_rest->name)->first();
            // };
            $new_rest->save();
        }
    }
}
