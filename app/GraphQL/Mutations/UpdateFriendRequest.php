<?php

namespace App\GraphQL\Mutations;

use App\Enums\StatusType;
use App\Models\Friend;
use App\Models\User;
use Carbon\Carbon;

class UpdateFriendRequest
{
    /**
     * @param null $_
     * @param array<string, mixed> $args
     */
    public function __invoke($_, array $args)
    {

        if ($args['status'] === StatusType::ACCEPTED) {
//            Jeśli akceptuje - dodajemy go jako przyjaciela dla usera i przyjaciela
            $user = $this->updateOrAttachFriend($args['id'], $args['friend_id'], $args['status'], Carbon::now());
            $friend = $this->updateOrAttachFriend($args['friend_id'], $args['id'], $args['status'], Carbon::now());
        } else {
//            Jeśli odrzuci to zmieniamy status u usera
            $user = User::whereId($args['id'])->firstOrFail();
            $user->relationships()->updateExistingPivot($args['friend_id'], ['status' => $args['status']]);
        }

        return $user;
    }

    private function updateOrAttachFriend($userId, $friendId, $status, $confirmed_at = null)
    {
        $user = User::whereId($userId)->firstOrFail();
        $userRequest = Friend::where('user_id', $userId)->where('friend_id', $friendId)->first();
        if (!$userRequest)
            $user->relationships()->attach($friendId, ['status' => $status, 'confirmed_at' => $confirmed_at]);
        else {
            $userRequest->status = $status;
            $userRequest->confirmed_at = $confirmed_at;
            $userRequest->save();
        }

        return $user;
    }
}
