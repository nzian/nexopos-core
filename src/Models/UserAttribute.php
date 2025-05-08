<?php

namespace Ns\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int   $id
 * @property int   $user_id
 * @property mixed $avatar_link
 * @property mixed $theme
 * @property mixed $language
 */
class UserAttribute extends NsRootModel
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'users_attributes';

    protected $fillable = [ 'language' ];
}
