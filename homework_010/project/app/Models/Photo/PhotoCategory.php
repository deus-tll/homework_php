<?php

namespace App\Models\Photo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhotoCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function photos() : HasMany
    {
        return $this->hasMany(Photo::class, 'category_id', 'id');
    }
}
