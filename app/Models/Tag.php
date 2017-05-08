<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $table = 'tags';
    public $fillable = ['name'];
    public $timestamps = false;
    public $relations = [
        'posts'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
