<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'title', 'category', 'content', 'image_url', 'author', 'read_time'
    ];
}
