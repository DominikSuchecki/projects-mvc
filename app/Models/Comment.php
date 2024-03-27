<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Task;


class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'author_id', 'task_id', 'parent_id', 'attachement_path'];

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

}
