<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    public function documents()
    {
        return $this->hasMany(ApplicantDocument::class);
    }
}
