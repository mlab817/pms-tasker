<?php

namespace Database\Seeders;

use App\Models\RequestType;
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
        // \App\Models\User::factory(10)->create();
	    $this->call(TasksTableSeeder::class);
	    $this->call(RequestType::class);
	    $this->call(StatusesTableSeeder::class);
	    $this->call(EndusersTableSeeder::class);
    }
}
