<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class kriteria extends Model
{
    //use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'id_kriteria';

    protected $fillable = [
        'id_kriteria',
        'kode_kriteria',
        'nama_kriteria',
    ];

    // public function Crips()
    // {
    //     return $this->hasMany(Crips::class);
    // }
}
