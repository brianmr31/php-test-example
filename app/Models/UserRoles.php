<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRoles extends Model
{
    use SoftDeletes;
    protected $table = 'user_roles';

    protected $primaryKey = 'id_user_role';

    protected $keyType = 'integer';

    protected $fillable = ['id_role', 'id_user', 'deleted_at', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->hasOne(Users::class, 'id_user', 'id_user');
    }
    public function role()
    {
        return $this->hasOne(Roles::class, 'id_role', 'id_role');
    }
}
