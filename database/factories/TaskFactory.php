<?php

namespace Database\Factories;

use App\Models\Action;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
	        'action_id' => Action::all()->random()->id,
			'other_actions' => $this->faker->title,
			'user_id' => User::all()->random()->id,
			'details' => $this->faker->sentence,
			'remarks' => $this->faker->paragraph,
			'status_id' => Status::all()->random()->id,
			'created_by' => User::all()->random()->id,
        ];
    }
}
