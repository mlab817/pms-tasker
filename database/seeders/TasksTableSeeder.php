<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = File::get(database_path() . '/seeders/json/tasks.json');
        $json = json_decode($file);

        dd($json);

        foreach ($json as $task) {
        	Task::create([

	        ]);
        }
    }
}
