<?php

namespace App\GraphQL\Mutations;

use App\Enums\StatusType;
use App\Models\User;
use Carbon\Carbon;

class UpdateOrCreateFriend
{
    /**
     * @param null $_
     * @param array<string, mixed> $args
     */
    public function __invoke($_, array $args)
    {
        $user = User::whereId($args['id'])->firstOrFail();
        $friend = User::whereId($args['friend_id'])->firstOrFail();

        if ($args['status'] === StatusType::PENDING) {
//            Dwa oczekujące zaproszenia skutkują dodaniem do znajomych
            if ($friend->relationships()->where(['friend_id' => $args['id'], 'status' => StatusType::PENDING])->exists()) {
                $this->updateOrCreateRelationship($user, $args['friend_id'], $args['status'], Carbon::now());
                $this->updateOrCreateRelationship($friend, $args['id'], $args['status'], Carbon::now());
            } else {
                $this->updateOrCreateRelationship($user, $args['friend_id'], $args['status']);
            }
//            Zaakceptowanie zaproszenia dodaje do listy znajomych - frienda do usera i odwrotnie
        } else if ($args['status'] === StatusType::ACCEPTED) {
            $this->updateOrCreateRelationship($user, $args['friend_id'], $args['status'], Carbon::now());
            $this->updateOrCreateRelationship($friend, $args['id'], $args['status'], Carbon::now());
        } else {
            $this->updateOrCreateRelationship($user, $args['friend_id'], $args['status']);
        }

        return $user;

    }

    private function updateOrCreateRelationship($user, $friend_id, $status, $confirmed_at = null)
    {
        if ($user->relationships()->where('friend_id', $friend_id)->exists()) {
            $user->relationships()->updateExistingPivot($friend_id, ['status' => $status, 'confirmed_at' => $confirmed_at]);
        } else {
            $user->relationships()->attach($friend_id, ['status' => $status, 'confirmed_at' => $confirmed_at]);
        }
    }
}
