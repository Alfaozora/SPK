<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class crips extends Model
{
    //use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'id_crips';

    protected $fillable = [
        'id_crips',
        'id_kriteria',
        'nama',
        'keterangan',
        'nilai'
    ];

    // public function Kriteria()
    // {
    //     return $this->belongsTo(Kriteria::class);
    // }
}
