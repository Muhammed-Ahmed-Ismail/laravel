<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function commentable()
    {
        return $this->morphTo();
    }
    public function user()
    {
       return $this->belongsTo(User::class,'user_id');
    }
    protected $fillable=[
        'commentable_id',
        'comment',
        'user_id',
    ];
}
