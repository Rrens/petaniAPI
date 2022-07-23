<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class petanis extends Model
{
    use HasFactory;
    public $primary_key = 'id';
    protected $table = 'petanis';
    protected $fillable = [
        'nama_petani', 'nik', 'alamat', 'telp', 'foto', 'id_kelompok_jenis', 'status'
    ];

    static function getPetani()
    {
        // $data = DB::table('petanis')->get();
        $data = DB::table('petanis')
            ->join('kelompok_jenis', 'petanis.id_kelompok_jenis', '=', 'kelompok_jenis.id');
        return $data;
    }
}
