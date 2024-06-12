<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'upload_image', 'description', 'slug', 'category_id'];


    /**
     * Get the category that owns the Photo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo //Una photo appartiene a una category
    {
        return $this->belongsTo(Category::class);
    }
}
