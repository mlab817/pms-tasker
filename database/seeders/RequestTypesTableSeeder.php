<?php

namespace Database\Seeders;

use App\Models\RequestType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RequestTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
        	[
        		'name' => 'Procurement Request Action Slip',
		        'acronym' => 'PRAS',
		        'slug' => Str::slug('Procurement Request Action Slip')
	        ],
	        [
	        	'name' => 'Purchase Request',
		        'acronym' => 'PR',
		        'slug' => Str::slug('Purchase Request')
	        ],
        ];

        foreach ($seeds as $seed) {
        	RequestType::create($seed);
        }
    }
}
