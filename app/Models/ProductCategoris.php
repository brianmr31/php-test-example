<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategoris extends Model
{
    use SoftDeletes;
    protected $table = 'product_categorys';

    protected $primaryKey = 'id_product_category';

    protected $keyType = 'integer';

    protected $fillable = ['id_product', 'id_category',
          'deleted_at', 'created_at', 'updated_at'];

    public function product()
    {
        return $this->hasOne(Products::class, 'id_product', 'id_product');
    }
    public function categoris()
    {
        return $this->hasOne(Categoris::class, 'id_category', 'id_category');
    }
}
