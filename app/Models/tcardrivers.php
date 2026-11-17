<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tcardrivers extends Model
{
    use HasFactory;

    protected $table = 'tcardrivers';
    public $timestamps = false;
    protected $fillable = ['plate', 'driver_id'];
}
