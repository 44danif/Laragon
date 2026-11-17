<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tcars extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'plate';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['plate', 'brand', 'model', 'color'];

    public function revisions()
    {
        return $this->hasMany(trevisions::class, 'plate', 'plate');
    }

    public function drivers()
    {
        return $this->belongsToMany(tdrivers::class, 'tcardrivers', 'plate', 'driver_id', 'plate', 'id');
    }
}