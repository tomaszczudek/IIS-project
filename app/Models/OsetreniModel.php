<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class OsetreniModel extends Model
{
    protected $table = 'osetreni';
    public $timestamps = false;
    protected $fillable = [
        'radky_id',
        'datum',
        'datum_provedeni',
        'typ_enum',
        'postrik_typ',
        'koncentrace',
        'poznamka',
        'stav',
    ];

    public function radky() : BelongsTo
    {
        return $this->belongsTo(RadkyModel::class, 'radky_id');
    }
}
