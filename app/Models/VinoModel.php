<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class VinoModel extends Model
{
    protected $table = 'vino';
    public $timestamps = false;
    
    protected $fillable = [
        'sklizen_id',
        'rocnik',
        'odruda',
        'procento_alkoholu',
        'pocet_vyrobenych_lahvi',
        'pocet_zbylych_lahvi',
        'datum_lahvovani',
        'cena'
    ];

    protected $casts = [
        'datum_lahvovani' => 'date',
        'procento_alkoholu' => 'decimal:2',
    ];

    public function sklizen(): BelongsTo
    {
        return $this->belongsTo(SklizenModel::class, 'sklizen_id');
    }

    public function polozky(): HasMany
    {
        return $this->hasMany(PolozkaModel::class, 'vino_id');
    }
}
