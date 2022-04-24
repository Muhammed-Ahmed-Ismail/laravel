<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;

    protected $fillable=[
        'title',
        'writer_id',
        'description',
        'slug',
        'photo_path'
    ];

    /*protected $casts=[
        'created_at'=>'datetime:Y-m-d'
    ];*/

    public function user()
    {
        return $this->belongsTo(User::class,'writer_id');
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
//dates
