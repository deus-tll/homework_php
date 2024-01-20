<?php

namespace App\Models\Photo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PhotoTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug'
    ];

    protected $hidden = ['pivot'];

    public function photos() : BelongsToMany
    {
        return $this->belongsToMany(Photo::class, 'pivot_photo_tags', 'tag_id', 'photo_id');
    }
}
