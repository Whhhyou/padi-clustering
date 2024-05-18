<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_perhitungan extends Model
{
    use HasFactory;
    protected $table = 'tb_perhitungan';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['id_kabupaten', 'tahun', 'luas_panen', 'produktivitas', 'produksi', 'cluster'];
    public $timestamps = true;

    public function id_kabupaten()
    {
        return $this->belongsTo(tb_kabupaten::class, 'id_kabupaten')->withDefault([
            'id_kabupaten' => 'tidak ada',
        ]);
    }

    public function namakabupaten()
    {
        return $this->belongsTo(tb_kabupaten::class, 'id_kabupaten')->withDefault([
            'nama_kabupaten' => 'tidak ada',
        ]);
    }
}
