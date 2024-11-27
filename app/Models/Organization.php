<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'person',
        'rfc',
        'address',
        'email',
        'phone'
    ];

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class);
    }
}
