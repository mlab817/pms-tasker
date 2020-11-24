<?php

namespace Database\Seeders;

use App\Models\RequestType;
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
		    RequestType::create([
			    'name' => $seed,
			    'slug' => Str::slug($seed),
		    ]);
	    }
    }
}
