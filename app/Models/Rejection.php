<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rejection extends Model
{
    protected $fillable = ['applicant_id', 'order_no', 'remark', 'is_rejected'];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function docs()
    {
        return $this->hasMany(Doc::class);
    }
}
