<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    protected $fillable = [
        'applicant_id',   // foreign key to applicant
        'order_no',       // new column for the order number
        'file_path',
        'original_name',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
