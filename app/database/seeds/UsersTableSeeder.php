<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		DB::table('users')->truncate();
		
	// Uncomment the below to wipe the table clean before populating
		$user1 = User::create([
			'name' => 'Achyut Paudel',
			'password' => Hash::make('tuyhca'),
			'email' => 'achyut.pdl@gmail.com',
			'address' => $faker->address,
			'contact' => $faker->phoneNumber,
			'usertype' => 'Tutor'
		]);
		$user1->category()->sync([$faker->numberBetween($min = 1, $max = 10),$faker->numberBetween($min = 1, $max = 10),$faker->numberBetween($min = 1, $max = 10)]);
		$user1->subcategory()->sync([$faker->numberBetween($min = 1, $max = 10),$faker->numberBetween($min = 1, $max = 10),$faker->numberBetween($min = 1, $max = 10)]);
		// Uncomment the below to run the seeder
		 $user2 = User::create([
			'name' => 'Anmol Bhargawa',
			'password' => Hash::make('d'),
			'email' => 'a@bb.com',
			'address' => $faker->address,
			'contact' => $faker->phoneNumber,
			'usertype' => 'Tutor'
		]);
		$user2->category()->sync([$faker->numberBetween($min = 1, $max = 10),$faker->numberBetween($min = 1, $max = 10),$faker->numberBetween($min = 1, $max = 10)]);
		$user2->subcategory()->sync([$faker->numberBetween($min = 1, $max = 10),$faker->numberBetween($min = 1, $max = 10),$faker->numberBetween($min = 1, $max = 10)]);
		
		foreach(range(1, 10) as $index)
		{
			$user = User::create([
				'name' => $faker->name,
				'password' => Hash::make('tuyhca'),
				'email' => $faker->email,
				'address' => $faker->address,
				'contact' => $faker->phoneNumber,
				'usertype' => 'Tutor'
			]);
			$user->category()->sync([$faker->numberBetween($min = 1, $max = 10),$faker->numberBetween($min = 1, $max = 10),$faker->numberBetween($min = 1, $max = 10)]);
			$user->subcategory()->sync([$faker->numberBetween($min = 1, $max = 10),$faker->numberBetween($min = 1, $max = 10),$faker->numberBetween($min = 1, $max = 10)]);
		
		}
	}

}