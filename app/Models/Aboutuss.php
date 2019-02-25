<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aboutuss extends Model
{
    use SoftDeletes;
    protected $table = 'aboutuss';

    protected $primaryKey = 'id_about_us';

    protected $keyType = 'integer';

    protected $fillable = ['title', 'content', 'publish', 'id_user',
          'deleted_at', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->hasOne(Users::class, 'id_user', 'id_user');
    }
}
