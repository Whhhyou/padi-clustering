<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_kabupaten extends Model
{
    use HasFactory;
    protected $table = 'tb_kabupaten';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['nama_kabupaten'];

    public function tb_produksi()
    {
        return $this->hasMany(tb_produksi::class, 'id_kabupaten');
    }
}
