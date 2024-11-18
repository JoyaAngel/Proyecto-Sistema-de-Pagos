<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $primaryKey = 'idSupplier';

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'suplIdOrganization', 'idOrganization');
    }

    public function proyects()
    {
        return $this->belongsToMany(Project::class,'proyect_suppliers','prsuIdSupplier','prsuIdProyect');
    }
}
