<?php

namespace App\GraphQL\Mutations;

use App\Http\Controllers\Teamwork\TeamMemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Mpociot\Teamwork\Facades\Teamwork;
use Mpociot\Teamwork\TeamInvite;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class TeamworkMutation
{
	/**
	 * @param                                                     $_
	 * @param array                                               $args
	 *
	 * @param \Nuwave\Lighthouse\Support\Contracts\GraphQLContext $context
	 *
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	public function acceptInvite($_, array $args, GraphQLContext $context)
	{
		$token = $args['token'];
		$invite = Teamwork::getInviteFromAcceptToken($token);
		$user = $context->user();

		if ($user) {
			Teamwork::acceptInvite($invite);
		}
		return $user;
	}

	/**
	 * @param                                                     $_
	 * @param array                                               $args
	 * @param \Nuwave\Lighthouse\Support\Contracts\GraphQLContext $context
	 *
	 * @return mixed
	 */
	public function createTeam($_, array $args, GraphQLContext $context)
	{
		$teamModel = config('teamwork.team_model');
		$user = $context->user();

		$team = $teamModel::create([
			'name' => $args['name'],
			'owner_id' => $user->id,
		]);

		$user->attachTeam($team);

		return $team;
	}

	public function updateTeam($_, array $args, GraphQLContext $context)
	{
		$teamModel = config('teamwork.team_model');
		$team = $teamModel::findOrFail($args['id']);
		$user = $context->user();

		if (! $user->isOwnerOfTeam($team)) {
			return null;
		}

		$team->name = $args['name'];
		$team->save();

		return $team;
	}

	public function switchTeam($_, array $args, GraphQLContext $context)
	{
		$teamModel = config('teamwork.team_model');
		$team = $teamModel::find($args['id']);
		$user = $context->user();

		if (!$team || !$user) {
			return null;
		}

		$user->switchTeam($team);

		return $user;
	}

	public function deleteTeam($_, array $args, GraphQLContext $context)
	{
		$teamModel = config('teamwork.team_model');
		$user = $context->user();

		$team = $teamModel::find($args['id']);
		if (! $user->isOwnerOfTeam($team)) {
			return null;
		}

		$team->delete();

		$userModel = config('teamwork.user_model');
		$userModel::where('current_team_id', $args['id'])
			->update(['current_team_id' => null]);

		return $team;
	}

	/**
	 * @param                                                     $_
	 * @param array                                               $args
	 * @param \Nuwave\Lighthouse\Support\Contracts\GraphQLContext $context
	 *
	 * @return $this
	 */
	public function invite($_, array $args, GraphQLContext $context)
	{
		$teamModel = config('teamwork.team_model');
		$team = $teamModel::find($args['team_id']);
		$email = $args['email'];
		$message = '';

		if (! Teamwork::hasPendingInvite($email, $team)) {
			Teamwork::inviteToTeam($email, $team, function ($invite) {
				Mail::send('teamwork.emails.invite', ['team' => $invite->team, 'invite' => $invite], function ($m) use ($invite) {
					$m->to($invite->email)->subject('Invitation to join team '.$invite->team->name);
				});
			});
			$message = 'Successfully invited user';
		} else {
			$message = 'The email address is already invited to the team.';
		}

		return $message;
	}

	/**
	 * Resend an invitation mail.
	 *
	 * @param                                                     $_
	 * @param array                                               $args
	 * @param \Nuwave\Lighthouse\Support\Contracts\GraphQLContext $context
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function resendInvite($_, array $args, GraphQLContext $context)
	{
		$invite = TeamInvite::find($args['invite_id']);
		Mail::send('teamwork.emails.invite', ['team' => $invite->team, 'invite' => $invite], function ($m) use ($invite) {
			$m->to($invite->email)->subject('Invitation to join team '.$invite->team->name);
		});

		return 'Resent invite to user';
	}

}
