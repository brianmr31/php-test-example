<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    use SoftDeletes;
    protected $table = 'roles';

    protected $primaryKey = 'id_role';

    protected $keyType = 'integer';

    protected $fillable = ['name_role', 'deleted_at', 'created_at', 'updated_at'];

    public function access()
    {
        return $this->hasMany(RoleAccess::class, 'id_role', 'id_role');
    }
    public function users()
    {
        return $this->hasMany(UserRoles::class, 'id_role', 'id_role');
    }
}
