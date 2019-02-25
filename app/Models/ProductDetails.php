<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetails extends Model
{
    use SoftDeletes;
    protected $table = 'product_details';

    protected $primaryKey = 'id_product_detail';

    protected $keyType = 'integer';

    protected $fillable = ['size', 'thickness', 'finish',
          'deleted_at', 'created_at', 'updated_at'];

    public function products()
    {
        return $this->hasMany(ProductProductDetails::class, 'id_product_detail', 'id_product_detail');
    }
}
