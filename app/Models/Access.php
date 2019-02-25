<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Access extends Model
{
    use SoftDeletes;
    protected $table = 'access';

    protected $primaryKey = 'id_access';

    protected $keyType = 'integer';

    protected $fillable = ['name_access', 'deleted_at', 'created_at', 'updated_at'];

    public function users()
    {
        return $this->hasMany(RoleAccess::class, 'id_access', 'id_access');
    }
}
