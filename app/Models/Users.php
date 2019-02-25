<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model {
    use SoftDeletes ;
    protected $table = 'users';

    protected $primaryKey = 'id_user';

    protected $keyType = 'integer';

    protected $fillable = ['id_role', 'id_token', 'fullname','username' ,'password', 'email', 'company', 'status',
        'gender', 'birth_day', 'phone','deleted_at', 'created_at', 'updated_at'];
    public function role()
    {
        return $this->hasMany(UserRoles::class, 'id_role', 'id_role');
    }

    public function token()
    {
        return $this->hasOne(Tokens::class, 'id_token', 'id_token');
    }
}
