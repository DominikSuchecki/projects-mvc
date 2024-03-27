<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Project;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'nip',
        'regon',
        'krs',
        'owner_first_name',
        'owner_last_name',
        'owner_email',
        'owner_phone',
    ];

    public function project()
    {
        return $this->hasOne(Project::class);
    }
}
