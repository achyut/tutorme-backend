<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ReviewsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		DB::table('reviews')->truncate();
		foreach(range(1, 10) as $index)
		{
			
			Review::create([
				'post' => $faker->numberBetween($min = 1, $max = 10),
				'rating' => $faker->numberBetween($min = 1, $max = 5),
				'review' => $faker->sentences($nb = 3, $asText = true),
				'created_by' => $faker->numberBetween($min = 1, $max = 10)
			]);
		}
		
	}

}