<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SosialMedias extends Model
{
    use SoftDeletes;
    protected $table = 'sosial_medias';

    protected $primaryKey = 'id_sosial_media';

    protected $keyType = 'integer';

    protected $fillable = ['name_sosial_media', 'url', 'publish',
          'deleted_at', 'created_at', 'updated_at'];
}
