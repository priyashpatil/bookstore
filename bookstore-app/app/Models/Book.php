<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Book extends Model
{
    use Searchable;
    use HasFactory;

    protected $casts = [
        'published' => 'immutable_date',
    ];
}
