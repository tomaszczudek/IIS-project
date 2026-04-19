<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NakupyModel extends Model
{
    protected $table = 'nakupy';
    public $timestamps = false;
    
    protected $fillable = [
        'user_id',
        'datum_nakupu',
        'stav_enum'
    ];

    protected $casts = [
        'datum_nakupu' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function polozky(): HasMany
    {
        return $this->hasMany(PolozkaModel::class, 'nakup_id');
    }
}
