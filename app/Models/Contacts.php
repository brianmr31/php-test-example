<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacts extends Model
{
    use SoftDeletes;
    protected $table = 'contacts';

    protected $primaryKey = 'id_contact';

    protected $keyType = 'integer';

    protected $fillable = ['phone', 'address', 'email', 'id_user', 
         'deleted_at', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->hasOne(Users::class, 'id_user', 'id_user');
    }
}
