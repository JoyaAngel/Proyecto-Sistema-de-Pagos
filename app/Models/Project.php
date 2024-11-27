<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'client_id',
        'start_date',
        'end_date',
        'subtotal',
        'tax',
        'total',
        'concept',
        'comments'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class);
    }

    public function advances()
    {
        return $this->hasMany(Advance::class);
    }
}
