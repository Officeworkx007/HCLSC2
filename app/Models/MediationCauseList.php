<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MediationCauseList extends Model
{
    use HasFactory;

    // Explicit table name
    protected $table = 'mediation_causelists';

    // Mass assignable fields
    protected $fillable = [
        'cause_list_date',
        'description',
        'file_path',
        'status',
        'uploaded_by',
    ];

    protected $casts = [
        'cause_list_date' => 'date',
    ];

    public function uploader()
    {
        return $this->belongsTo(\App\Models\User::class, 'uploaded_by');
    }
}
