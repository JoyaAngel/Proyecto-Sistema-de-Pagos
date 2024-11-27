<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = [
        'amount',
        'date',
        'payment_method',
    ];

    // Evento para generar la referencia automáticamente antes de crear el registro
    public static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            $transaction->reference = Str::random(15);
        });
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function advance()
    {
        return $this->hasOne(Advance::class);
    }

    public function projectSuppliers()
    {
        return $this->belongsToMany(ProjectSupplier::class, 'project_supplier', 'transaction_id', 'project_id');
    }
}
