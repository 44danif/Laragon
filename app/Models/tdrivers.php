<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tdrivers extends Model
{
     use HasFactory;

    protected $table = 'tdrivers';
    public $timestamps = false;
    protected $fillable = ['nom', 'cognoms', 'dni', 'telefon'];

    public function cars()
    {
        return $this->belongsToMany(tcars::class, 'tcardrivers', 'driver_id', 'plate', 'id', 'plate');
    }
}
