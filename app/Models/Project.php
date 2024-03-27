<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Task;
use App\Models\Client;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'client_id', 'description', 'start_date', 'end_date', 'status'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_projects', 'project_id', 'user_id');
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
