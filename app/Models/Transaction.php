
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $primaryKey = 'idTransaction';
    protected $fillable = [
        'name',
        'ammount',
        'type',
        'date',
        'method',
        'reference',
    ];

    protected $primaryKey = 'idOrganization';
}


