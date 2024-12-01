<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSupplier extends Model
{
    use HasFactory;

    protected $table = 'project_supplier';
    protected $primaryKey = 'id';

    protected $fillable = [
        'project_id',
        'supplier_id',
        'service_cost'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    
}
