<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSupplier extends Model
{
    use HasFactory;

    protected $table = 'project_supplier';
    protected $primaryKey = 'id';

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    
}
