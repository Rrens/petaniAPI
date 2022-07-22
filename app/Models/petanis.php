<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class petanis extends Model
{
    use HasFactory;
    public $primary_key = 'id';
    protected $table = 'petanis';
    protected $fillable = [
        'nama_petani', 'nik', 'alamat', 'telp', 'foto', 'id_kelompok_jenis', 'status'
    ];
}
