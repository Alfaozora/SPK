<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perbandingan_alternatif extends Model
{
    use HasFactory;
    protected $table = 'perbandingan_alternatifs';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'alternatif_id', 'kode_alternatif', 'bobot'];
    public function alternatif()
    {
        return $this->belongsTo(alternatif::class);
    }
}
