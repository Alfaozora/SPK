<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alternatif extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'alternatifs';
    protected $fillable = ['id', 'kode', 'nkk', 'nik', 'nama', 'alamat', 'nomor'];

    //relasi dengan tabel pemeringkatan (one to one)
    public function pemeringkatan()
    {
        return $this->hasMany(pemeringkatan::class, 'alternatif_id', 'kode');
    }
}
