<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menus extends Model
{
    use SoftDeletes;
    protected $table = 'menus';

    protected $primaryKey = 'id_menu';

    protected $keyType = 'integer';

    protected $fillable = ['name_menu', 'id_role', 'deleted_at', 'created_at', 'updated_at'];

    public function role()
    {
        return $this->hasOne(Roles::class, 'id_role', 'id_role');
    }
}
