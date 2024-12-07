<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'author_id']; // Kolom yang dapat diisi secara massal

    // Relasi Many-to-Many dengan Category melalui tabel pivot article_category
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'article_category');
    }

    // Relasi Many-to-Many dengan Tag
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // Relasi BelongsTo dengan Author (karena setiap artikel memiliki satu author)
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
