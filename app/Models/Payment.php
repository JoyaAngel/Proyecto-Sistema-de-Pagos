<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'transaction_id',
        'project_supplier_id',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function projectSupplier()
    {
        return $this->belongsTo(ProjectSupplier::class);
    }
}
