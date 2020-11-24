<?php

namespace Database\Seeders;

use App\Models\Enduser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class EndusersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = File::get(database_path(). '/seeders/json/endusers.json');
        $json = json_decode($file);

        foreach ($json as $enduser) {
        	Enduser::create([
        		'name' => $enduser->label,
		        'slug' => Str::slug($enduser->label),
	            'acronym' => $enduser->value,
	        ]);
        }
    }
}
