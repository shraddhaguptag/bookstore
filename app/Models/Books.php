<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_path',
        'genre',
        'isbn',
        'author',
        'publication_date',
    ];
}
