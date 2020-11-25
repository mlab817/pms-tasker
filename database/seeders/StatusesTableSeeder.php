<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $seeds = ['Ongoing','Completed','Cancelled'];

	    foreach ($seeds as $seed) {
		    Status::create([
			    'name' => $seed,
			    'slug' => Str::slug($seed),
		    ]);
	    }
    }
}
