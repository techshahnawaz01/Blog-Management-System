<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'tags'
    ];

    // Blog belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Blog has many comments (only main comments, not replies)
    public function comments()
    {
        // parent_id null hone ka matlab hai ye replies nahi, main comments hain
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    // Scope for searching blogs by title
    public function scopeSearch($query, $term)
    {
        return $query->where('title', 'like', "%{$term}%");
    }
}
