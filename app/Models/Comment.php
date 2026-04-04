<?php

 namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body', 'user_id', 'blog_id', 'parent_id'];

    // Comment belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Self-referencing relationship for Parent
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Recursive relationship for Replies (Infinite Nesting) 
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('replies', 'user');
    }
}
