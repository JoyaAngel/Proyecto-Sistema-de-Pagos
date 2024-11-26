<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $primaryKey = 'idOrganization';
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
        return $this->hasOne(Client::class, 'clieIdOrganization');
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'suplIdOrganization');
    }
}
