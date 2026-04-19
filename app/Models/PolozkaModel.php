<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class PolozkaModel extends Model
{
    protected $table = 'polozka';
    public $timestamps = false;
    
    protected $fillable = [
        'nakup_id',
        'vino_id',
        'pocet_lahvi',
    ];

    public function nakup(): BelongsTo
    {
        return $this->belongsTo(NakupyModel::class, 'nakup_id');
    }

    public function vino(): BelongsTo
    {
        return $this->belongsTo(VinoModel::class, 'vino_id');
    }
}
