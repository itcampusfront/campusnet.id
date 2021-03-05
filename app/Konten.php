<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'konten';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_konten';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_topik', 'jenis_konten', 'nama_konten', 'konten_order', 'konten_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
