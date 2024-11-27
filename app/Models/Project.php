<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $primaryKey = 'idProject';
    protected $fillable = [
        'name',
        'projIdClient',
        'start_date',
        'end_date',
        'subtotal',
        'tax',
        'total',
        'concept',
        'status',
        'comments'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'projIdClient', 'idClient');
    }

    public function supplier()
    {
        return $this->belongsToMany(Supplier::class,'project_suppliers', 'prsuIdProject', 'prsuIdSupplier');
    }
}
