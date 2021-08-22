<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $primaryKey = 'iso';  //esta sera la llave primaria
    public $incrementing = false; // no se autoincrementara

    protected $fillable = [
        'iso',
    ];
}
