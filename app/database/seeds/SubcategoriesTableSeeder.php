<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SubcategoriesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 30) as $index)
		{
			Subcategory::create([
				'name' => "Subcategory ".$faker->word,
				'category' => $faker->numberBetween($min = 1, $max = 10)
			]);
		}
	}

}