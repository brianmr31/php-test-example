<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoryDownloads extends Model
{
    use SoftDeletes;
    protected $table = 'history_downloads';

    protected $primaryKey = 'id_history_download';

    protected $keyType = 'integer';

    protected $fillable = ['id_product', 'id_user', 
          'deleted_at', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->hasOne(Users::class, 'id_user', 'id_user');
    }
}
