<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tokens extends Model {
    use SoftDeletes ;
    protected $table = 'tokens';

    protected $primaryKey = 'id_token';

    protected $keyType = 'integer';

    protected $fillable = ['token', 'device', 'platform', 'login_history', 'logout_history', 'exp_at', 'deleted_at', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->hasOne(Users::class, 'id_token', 'id_token');
    }
}
