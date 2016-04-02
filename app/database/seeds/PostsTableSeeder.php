<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();


		foreach(range(1, 10) as $index)
		{
			Post::create([
				'title' => $faker->name,
				'shortdesc' => $faker->sentences($nb = 3, $asText = true),
				'longdesc' => $faker->text($maxNbChars = 200),
				'price' => $faker->numberBetween($min = 100, $max = 900),
				'rating' => $faker->numberBetween($min = 1, $max = 5),
				'startdate' => $faker->dateTime($max = 'now'),
				'enddate' => $faker->dateTime($max = 'now'),
				'starttime' => $faker->dateTime($max = 'now'),
				'endtime' => $faker->dateTime($max = 'now'),
				'address' => $faker->address,
				'contact' => $faker->phoneNumber,
				'email' => $faker->email,
				'preferedcontact' => 'mobile',
				'category' => $faker->numberBetween($min = 1, $max = 10),
				'subcategory' => $faker->numberBetween($min = 1, $max = 20),
				'created_by' => $faker->numberBetween($min = 1, $max = 10)
			]);
		}

		foreach(range(1, 5) as $index)
		{
			Post::create([
				'title' => $faker->name,
				'shortdesc' => $faker->sentences($nb = 3, $asText = true),
				'longdesc' => $faker->text($maxNbChars = 200),
				'price' => $faker->numberBetween($min = 100, $max = 900),
				'rating' => $faker->numberBetween($min = 1, $max = 5),
				'startdate' => $faker->dateTime($max = 'now'),
				'enddate' => $faker->dateTime($max = 'now'),
				'starttime' => $faker->dateTime($max = 'now'),
				'endtime' => $faker->dateTime($max = 'now'),
				'address' => $faker->address,
				'contact' => $faker->phoneNumber,
				'email' => $faker->email,
				'preferedcontact' => 'mobile',
				'category' => $faker->numberBetween($min = 1, $max = 10),
				'subcategory' => $faker->numberBetween($min = 1, $max = 20),
				'created_by' => 1
			]);
		}
		
	}

}