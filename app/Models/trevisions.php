<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trevisions extends Model
{
    use HasFactory;

    protected $table = 'trevisions';
    public $timestamps = false;
    protected $fillable = ['plate', 'data', 'descripcio', 'cost'];

    // Cada revisión pertenece a UN coche
    public function car()
    {
        return $this->belongsTo(tcars::class, 'plate', 'plate');
    }
}