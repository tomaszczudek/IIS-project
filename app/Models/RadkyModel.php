<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class RadkyModel extends Model
{
    protected $table = 'radky';
    public $timestamps = false;

    protected $fillable = [
        'odruda_enum',
        'pocet_hlav',
        'rok_vysadby',
    ];

    public function osetreni() : HasMany
    {
        return $this->hasMany(OsetreniModel::class, 'radky_id');
    }
}
