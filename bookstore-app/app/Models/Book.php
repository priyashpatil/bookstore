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

    protected $fillable = ['title', 'author', 'genre', 'publisher', 'isbn', 'published', 'desc', 'image'];

    protected $casts = [
        'published' => 'immutable_date',
    ];
}
