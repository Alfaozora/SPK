<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class kriteria extends Model
{
    //use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'kode_kriteria';

    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'jumlah_kriteria',
        'bobot_kriteria'
    ];

    // public function Crips()
    // {
    //     return $this->hasMany(Crips::class);
    // }
}
