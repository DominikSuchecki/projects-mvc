<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Project;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'start_date', 'end_date', 'priority', 'status', 'attachement_path'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_tasks', 'task_id', 'user_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
