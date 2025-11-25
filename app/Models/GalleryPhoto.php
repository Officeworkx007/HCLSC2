<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryPhoto extends Model
{
    use HasFactory;

    protected $table = 'gallery_photo';
    protected $fillable = [
        'gallery_album_id',
        'file_path',
        'file_name',
        'order_column',
        'is_cover',
        'caption',
    ];

    protected $casts = [
        'is_cover' => 'boolean',
    ];

    /**
     * Get the album that owns the photo.
     */
    public function album(): BelongsTo
    {
        return $this->belongsTo(GalleryAlbum::class, 'gallery_album_id');
    }
}
