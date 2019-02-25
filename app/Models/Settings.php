<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model
{
    use SoftDeletes;
    protected $table = 'settings';

    protected $primaryKey = 'id_setting';

    protected $keyType = 'integer';

    protected $fillable = ['value', 'key', 'status',
          'deleted_at', 'created_at', 'updated_at'];

}
