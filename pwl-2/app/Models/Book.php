<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function bookshelfs(): BelongsTo
    {
        return $this->belongsTo(Bookshelfs::class);  
    }
    protected $fillable = [
        'title',
        'author',
        'year',
        'publisher',
        'city',
        'quantity',
        'bookshelf_id',
        'cover',
    ];
}

