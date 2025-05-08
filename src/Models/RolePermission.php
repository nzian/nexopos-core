<?php

namespace Ns\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $role_id
 */
class RolePermission extends NsRootModel
{
    use HasFactory;

    protected $table = 'role_permission';

    public $timestamps = false;

    public $incrementing = false;
}
