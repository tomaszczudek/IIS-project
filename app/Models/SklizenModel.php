<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class SklizenModel extends Model
{
    protected $table = 'sklizen';
    public $timestamps = false;
    
    protected $fillable = [
        'radek_id',
        'hmotnost_hroznu_kg',
        'litry_vina',
        'odruda_hroznu',
        'cukernatost_hroznu',
        'datum_sklizne',
    ];

    protected $casts = [
        'datum_sklizne' => 'date',
        'hmotnost_hroznu_kg' => 'decimal:2',
        'litry_vina' => 'decimal:2',
        'cukernatost_hroznu' => 'decimal:2',
    ];

    public function radek(): BelongsTo
    {
        return $this->belongsTo(RadkyModel::class, 'radek_id');
    }

    public function vina(): HasMany
    {
        return $this->hasMany(VinoModel::class, 'sklizen_id');
    }
}
