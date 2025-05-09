<?php

namespace Ns\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int    $id
 * @property string $file
 */
class ModuleMigration extends NsModel
{
    use HasFactory;

    protected $table = 'modules_migrations';

    public $timestamps = false;

    public function scopeNamespace( $query, $namespace )
    {
        return $query->where( 'namespace', $namespace );
    }
}
