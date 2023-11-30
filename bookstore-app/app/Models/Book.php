<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Book extends Model
{
    use Searchable;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'author', 'genre', 'publisher', 'isbn', 'published', 'desc', 'image', 'price', 'sale_price'];

    protected $casts = [
        'published' => 'immutable_date',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
    ];

    public function toSearchableArray(): array
    {
        $array = $this->toArray();

        return [
            'title' => $array['title'],
            'author' => $array['author'],
            'genre' => $array['genre'],
            'published' => $array['published'],
            'publisher' => $array['publisher'],
            'isbn' => $array['isbn'],
            'price' => (float) $array['price'],
            'sale_price' => (float) $array['sale_price'],
        ];
    }
}
