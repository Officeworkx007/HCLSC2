<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryAlbum extends Model
{
    use HasFactory, SoftDeletes; // Including SoftDeletes if you used it in the migration

    protected $table = 'gallery_album';
    protected $fillable = [
        'title',
        'event_date',
        'description',
        // 'user_id', // Uncomment if you track the creator
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    /**
     * Get the photos for the album.
     */
    public function photos(): HasMany
    {
        // Ensure 'album_id' is the foreign key column name in your photos table.
        // And ensure 'GalleryPhoto::class' is the correct photo model path.
        return $this->hasMany(GalleryPhoto::class, 'gallery_album_id');
    }
}
