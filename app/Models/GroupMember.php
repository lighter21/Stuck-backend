<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupMember extends Pivot
{
    protected $fillable = ['user_id', 'group_id'];
    public $timestamps = false;
    protected $table = 'group_members';
}
