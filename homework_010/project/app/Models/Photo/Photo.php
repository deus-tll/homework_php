<?php

namespace App\Models\Photo;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'place'
    ];

    protected $hidden = ['category_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(PhotoCategory::class, 'category_id');
    }

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(PhotoTag::class, 'pivot_photo_tags', 'photo_id', 'tag_id');
    }

    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function ($photo) {
            $photo->tags()->detach();

            if (Storage::exists($photo->url)) {
                Storage::delete($photo->url);
            }
        });
    }
}
