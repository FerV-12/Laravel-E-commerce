<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'description',
        'status',
        'popular',
        'image',
    ];
    
    
}
