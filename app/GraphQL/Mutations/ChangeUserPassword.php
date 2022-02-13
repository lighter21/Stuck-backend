<?php

namespace App\GraphQL\Mutations;
use App\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Validator;
use Nuwave\Lighthouse\Exceptions\ValidationException;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class ChangeUserPassword
{
    /**
     * @param $rootValue
     * @param array $args
     * @param GraphQLContext $context
     * @param ResolveInfo $resolveInfo
     * @return mixed
     * @throws ValidationException
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
       $user = User::whereId(request()->user()->id)->firstOrFail();

       if (Hash::check($args['input']['old_password'], $user->password)) {
           $user->password = Hash::make($args['input']['password']);
           $user->save();
           return $user;
       }
       throw new \Exception('Old password is incorrect');
    }
}
