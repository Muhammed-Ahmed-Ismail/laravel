<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'title',
        'writer_id',
        'description',
        'slug'
    ];
    protected $casts=[
        'created_at'=>'datetime:Y-m-d'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'writer_id');
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
