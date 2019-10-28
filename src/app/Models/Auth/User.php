<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Scope\UserScope;
use App\Models\Auth\Traits\Method\UserMethod;
use App\Models\Auth\Traits\Attribute\UserAttribute;
use App\Models\Auth\Traits\Relationship\UserRelationship;
use Laravel\Passport\HasApiTokens;

/**
 * Class User.
 */
class User extends BaseUser
{
    use HasApiTokens,
        UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope;
}
