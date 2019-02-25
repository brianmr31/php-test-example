<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoris extends Model
{
    use SoftDeletes;
    protected $table = 'categorys';

    protected $primaryKey = 'id_category';

    protected $keyType = 'integer';

    protected $fillable = ['name_category', 'alias_category', 'url',
          'deleted_at', 'created_at', 'updated_at'];

    public function products()
    {
        return $this->hasMany(ProductCategoris::class, 'id_category', 'id_category');
    }
}
