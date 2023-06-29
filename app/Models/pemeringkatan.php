<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemeringkatan extends Model
{
    use HasFactory;
    protected $table = 'pemeringkatans';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'alternatif_id', 'nama', 'bobot', 'peringkat'];
}
