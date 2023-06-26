<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_kriteria extends Model
{
    use HasFactory;
    protected $table = 'sub_kriterias';
    protected $fillable = ['kode_kriteria', 'nama_sub', 'bobot'];
    public function kriteria()
    {
        return $this->belongsTo(kriteria::class);
    }
}
