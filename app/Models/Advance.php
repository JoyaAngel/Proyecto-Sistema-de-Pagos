<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

}
