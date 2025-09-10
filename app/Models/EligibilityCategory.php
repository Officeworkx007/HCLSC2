<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EligibilityCategory extends Model
{
    use HasFactory;

    protected $table = 'eligibility_category';

    protected $fillable = ['name'];

    public $timestamps = false;
}
