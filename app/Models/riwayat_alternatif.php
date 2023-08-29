<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class riwayat_alternatif extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'cadangan_alternatif';
    protected $fillable = ['id', 'kode', 'nkk', 'nik', 'nama', 'alamat', 'nomor'];
}
