<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kelas';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_kelas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_kelas', 'slug_kelas', 'deskripsi_kelas', 'kategori_kelas', 'gambar_kelas', 'harga_kelas', 'level_kelas', 'pengajar_kelas', 'kelas_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
