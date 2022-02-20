<?php

namespace App\GraphQL\Mutations;

use App\Models\Group;

class ToggleMembership
{
    /**
     * @param null $_
     * @param array<string, mixed> $args
     */
    public function __invoke($_, array $args)
    {
        $group = Group::whereId($args['group_id'])->firstOrFail();

        if ($group->members()->where('user_id', $args['user_id'])->exists())
            $group->members()->detach($args['user_id']);
        else
            $group->members()->attach($args['user_id']);

        return $group;

    }
}
