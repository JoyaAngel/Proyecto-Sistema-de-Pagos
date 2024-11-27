<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;


    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function proyects()
    {
        return $this->hasMany(Project::class);
    }
}
