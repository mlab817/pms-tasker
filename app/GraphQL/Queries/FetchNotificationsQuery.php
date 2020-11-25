<?php

namespace App\GraphQL\Queries;

use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class FetchNotificationsQuery
{
	/**
	 * @param                                                     $rootValue
	 * @param array                                               $args
	 * @param \Nuwave\Lighthouse\Support\Contracts\GraphQLContext $context
	 *
	 * @return array|null
	 */
	public function notifications($rootValue, array $args, GraphQLContext $context)
	{
		$user = $context->user();

		if (!$user) {
			return null;
		}

		$notifications = $user->notifications;

		return $notifications;
	}

	/**
	 * @param                                                     $rootValue
	 * @param array                                               $args
	 * @param \Nuwave\Lighthouse\Support\Contracts\GraphQLContext $context
	 *
	 * @return array|null
	 */
	public function unreadNotifications($rootValue, array $args, GraphQLContext $context)
	{
		$user = $context->user();

		if (!$user) {
			return null;
		}

		$unreadNotifications = $user->unreadNotifications;

		return $unreadNotifications;
	}
}
