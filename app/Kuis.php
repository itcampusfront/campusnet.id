<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kuis';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_kuis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_kuis', 'judul_kuis', 'deskripsi_kuis', 'pertanyaan', 'pilihan', 'gambar_pertanyaan', 'gambar_pilihan', 'dimensi_pertanyaan', 'dimensi_pilihan', 'kunci_jawaban', 'kuis_author', 'kuis_at', 'kuis_up',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
