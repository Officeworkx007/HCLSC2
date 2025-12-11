<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarYear extends Model
{
    use HasFactory;

    // Custom table name
    protected $table = 'calendar_year_table';

    // Mass assignable fields
    protected $fillable = [
        'title',
        'event_date',
        'description',
        'link',
        'image',
    ];

    // Cast event_date to Carbon instance
    protected $casts = [
        'event_date' => 'date',
    ];
}
