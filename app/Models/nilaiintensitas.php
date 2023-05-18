<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilaiintensitas extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_nilai';
    protected $fillable = [
        'id_nilai',
        'jum_nilai',
        'keterangan'
    ];
}
