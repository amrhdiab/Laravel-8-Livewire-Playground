<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
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
		//Category::factory(5)->create();
		//Post::factory(100)->create();

		User::factory(10)->create();

		Category::factory(5)->has(Post::factory(20)->state([
			'user_id'    => fn() => User::inRandomOrder()->first(),
			'created_at' => fn() => now()->subDays(random_int(1, 10)),
		]))->create();

	}
}
