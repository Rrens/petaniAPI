<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelompok_jenis extends Model
{
    use HasFactory;
    public $primary_key = 'id';
    protected $table = 'kelompok_jenis';
    protected $fillable = [
        'nama_kelompok'
    ];
}
