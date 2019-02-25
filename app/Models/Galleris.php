<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galleris extends Model
{
    use SoftDeletes;
    protected $table = 'galleris';

    protected $primaryKey = 'id_gallery';

    protected $keyType = 'integer';

    protected $fillable = ['name_image', 'url', 'publish', 'id_user',
          'deleted_at', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->hasOne(Users::class, 'id_user', 'id_user');
    }
}
