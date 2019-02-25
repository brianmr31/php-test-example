<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductProductDetails extends Model
{
    use SoftDeletes;
    protected $table = 'product_product_details';

    protected $primaryKey = 'id_product_product_detail';

    protected $keyType = 'integer';

    protected $fillable = ['id_product', 'id_product_detail',
          'deleted_at', 'created_at', 'updated_at'];

    public function product()
    {
        return $this->hasOne(Products::class, 'id_product', 'id_product');
    }
    public function productDetail()
    {
        return $this->hasOne(ProductDetails::class, 'id_product_detail', 'id_product_detail');
    }
}
