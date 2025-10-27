<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class MediationCauseList extends Model
{
    use HasFactory;

    // explicit table name (your table is mediation_causelists)
    protected $table = 'mediation_causelists';

    // mass assignable
    protected $fillable = [
        'cause_list_date',
        'to_be_held_on',
        'description',
        'file_path',
        'status',        // optional: kept for backward compatibility if you used it elsewhere
        'uploaded_by',
    ];

    // cast dates to Carbon instances
    protected $casts = [
        'cause_list_date' => 'date',
        'to_be_held_on' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relation to the user/admin who uploaded the cause list
     */
    public function uploader()
    {
        return $this->belongsTo(\App\Models\User::class, 'uploaded_by');
    }

    /**
     * Dynamic status accessor.
     *
     * Logic:
     * - If to_be_held_on is null => 'unknown'
     * - If to_be_held_on is in the future (strictly after today) => 'upcoming'
     * - If to_be_held_on is today:
     *     - before 11:00 AM => 'upcoming'
     *     - >= 11:00 AM and < 6:00 PM => 'ongoing'
     *     - >= 6:00 PM => 'completed'
     * - If to_be_held_on is in the past (before today) => 'completed'
     *
     * Uses app timezone (Carbon::now()) so it follows Laravel's configured timezone.
     *
     * Use in Blade as: $list->dynamic_status
     */
    public function getDynamicStatusAttribute()
    {
        // ensure we have a held-on date
        if (!$this->to_be_held_on) {
            return 'unknown';
        }

        // Carbon instances using app timezone
        $now = Carbon::now(); // respects app timezone
        $held = Carbon::parse($this->to_be_held_on)->startOfDay();
        $today = Carbon::today();

        // If held date is in the future (strictly after today) -> upcoming
        if ($held->gt($today)) {
            return 'upcoming';
        }

        // If held date is before today -> completed
        if ($held->lt($today)) {
            return 'completed';
        }

        // Held date is today -> apply time thresholds (11:00 and 18:00)
        $startOngoing = Carbon::today()->setTime(11, 0, 0); // 11:00:00 today
        $endOngoing = Carbon::today()->setTime(18, 0, 0);   // 18:00:00 today

        if ($now->lt($startOngoing)) {
            return 'upcoming';
        }

        if ($now->gte($startOngoing) && $now->lt($endOngoing)) {
            return 'ongoing';
        }

        // now >= 18:00 on the held date
        return 'completed';
    }

    /** Convenience helpers */
    public function isUpcoming(): bool
    {
        return $this->dynamic_status === 'upcoming';
    }

    public function isOngoing(): bool
    {
        return $this->dynamic_status === 'ongoing';
    }

    public function isCompleted(): bool
    {
        return $this->dynamic_status === 'completed';
    }
}
