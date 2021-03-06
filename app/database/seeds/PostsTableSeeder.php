<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		DB::table('posts')->truncate();
		foreach(range(1, 10) as $index)
		{
			$spons = $faker->numberBetween($min = 0, $max = 1);
			$price = $faker->numberBetween($min = 100, $max = 500);
			if($spons==0){
				$price = 0;
			}
			Post::create([
				'title' => $faker->name,
				'shortdesc' => $faker->sentences($nb = 3, $asText = true),
				'longdesc' => $faker->text($maxNbChars = 200),
				'price' => $faker->numberBetween($min = 100, $max = 900),
				'rating' => $faker->numberBetween($min = 1, $max = 5),
				'sponsored' => $spons,
				'sponsorprice' => $price,
				'startdate' => $faker->dateTime($max = 'now'),
				'enddate' => $faker->dateTime($max = 'now'),
				'starttime' => $faker->dateTime($max = 'now'),
				'endtime' => $faker->dateTime($max = 'now'),
				//'address' => $faker->address,
				'address' => '1000 Greek row dr. Arlington, Texas 76013',
				//'contact' => $faker->phoneNumber,
				'contact' => '917-832-3967',
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
				//'address' => $faker->address,
				'address' => '1000 Greek row dr. Arlington, Texas 76013',
				//'contact' => $faker->phoneNumber,
				'contact' => '917-832-3967',
				'email' => $faker->email,
				'preferedcontact' => 'mobile',
				'category' => $faker->numberBetween($min = 1, $max = 10),
				'subcategory' => $faker->numberBetween($min = 1, $max = 20),
				'created_by' => 1
			]);
		}
		
	}

}