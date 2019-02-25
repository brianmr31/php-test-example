<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleAccess extends Model
{
    use SoftDeletes;
    protected $table = 'role_access';

    protected $primaryKey = 'id_role_access';

    protected $keyType = 'integer';

    protected $fillable = ['id_role', 'id_access', 'deleted_at', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->hasMany(Users::class, 'id_token', 'id_token');
    }
    public function access()
    {
        return $this->hasMany(Users::class, 'id_token', 'id_token');
    }
}
