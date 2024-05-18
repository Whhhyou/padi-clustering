<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_produksi extends Model
{
    use HasFactory;
    protected $table = 'tb_produksi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['id_kabupaten', 'tahun', 'luas_panen', 'produktivitas', 'produksi'];
    public $timestamps = true;

    public function tb_kabupaten()
    {
        return $this->belongsTo(tb_kabupaten::class, 'id');
    }
}
