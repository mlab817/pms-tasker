<?php

namespace App\GraphQL\Mutations;

use App\Models\Task;
use Carbon\Carbon;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CompleteTask
{
	/**
	 * @param null                 $_
	 * @param array<string, mixed> $args
	 *
	 * @return Task $task | null
	 */
    public function __invoke($_, array $args, GraphQLContext $context)
    {
        $task = Task::find($args['id']);

        if (! $task) {
        	return null;
        }

        $task->completed_at = Carbon::now();
        $task->status_id = 2; // set to completed
	    $task->updated_by = $context->user()->id;
        $task->save();

        return $task;
    }
}
