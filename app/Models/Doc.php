<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    protected $fillable = [
        'rejection_id',
        'file_path',
    ];

    public function rejection()
    {
        return $this->belongsTo(Rejection::class);
    }
}
