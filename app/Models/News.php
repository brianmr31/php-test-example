<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;
    protected $table = 'news';

    protected $primaryKey = 'id_new';

    protected $keyType = 'integer';

    protected $fillable = ['title', 'alias', 'context', 'publish', 'id_user', 'deleted_at', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->hasOne(Users::class, 'id_user', 'id_user');
    }
}
