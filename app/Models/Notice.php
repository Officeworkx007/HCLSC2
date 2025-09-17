<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'order_no',
        'notice_date',
        'status',
        'pdf_path',
    ];

    // Accessor for status label
    public function getStatusLabelAttribute()
    {
        return $this->status ? 'Active' : 'Not Active';
    }

    // Accessor for badge color
    public function getStatusClassAttribute()
    {
        return $this->status ? 'bg-green-500 text-white' : 'bg-red-500 text-white';
    }
}
