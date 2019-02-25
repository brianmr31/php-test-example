<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;
    protected $table = 'products';

    protected $primaryKey = 'id_product';

    protected $keyType = 'integer';

    protected $fillable = ['name_product', 'kode_product', 'url', 'hot',
        'publish', 'id_detail_product', 'deleted_at', 'created_at', 'updated_at'];

    public function productDetails()
    {
        return $this->hasMany(ProductProductDetails::class, 'id_product', 'id_product');
    }
    public function cateogries()
    {
        return $this->hasMany(ProductCategoris::class, 'id_product', 'id_product');
    }
}
