<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = ['organization_id'];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function proyects()
    {
        return $this->belongsToMany(Project::class);
    }
}
