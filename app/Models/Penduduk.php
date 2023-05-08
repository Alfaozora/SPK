<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama',
        'alamat',
        'nik'
    ];
}
