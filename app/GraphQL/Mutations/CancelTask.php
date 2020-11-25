<?php

namespace App\GraphQL\Mutations;

use App\Models\Task;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CancelTask
{
	/**
	 * @param null                                                $_
	 * @param array<string, mixed>                                $args
	 * @param \Nuwave\Lighthouse\Support\Contracts\GraphQLContext $context
	 *
	 * @return |null
	 */
    public function __invoke($_, array $args, GraphQLContext $context)
    {
	    $task = Task::find($args['id']);

	    if (! $task) {
		    return null;
	    }

	    $task->status_id = 3; // set to cancelled
	    $task->updated_by = $context->user()->id;
	    $task->save();

	    return $task;
    }
}
