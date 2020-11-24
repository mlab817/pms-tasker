<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ActionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = [
        	'Prepare RFQ',
	        'Prepare Resolution - Award',
	        'Prepare Resolution - Cancellation',
	        'Request for Reposting',
	        'Prepare Memo - Return to Enduser',
	        'Prepare Memo - Failed',
	        'Prepare Letter',
	        'For initial',
	        'Coordinate with enduser',
	        'Others',
        ];

        foreach ($actions as $seed) {
        	Action::create([
        		'name' => $seed,
		        'slug' => Str::slug($seed),
	        ]);
        }
    }
}
