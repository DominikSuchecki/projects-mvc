<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Project;
use App\Models\Invoices;

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

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
