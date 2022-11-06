<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$user = User::factory()
		->create(['name' => 'Giorgi', 'email' => 'giorgi@gmail.com']);

		Listing::factory(10)->create(['user_id' => $user->id]);
	}
}
