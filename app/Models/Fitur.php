<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fitur extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fitur';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_fitur';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_fitur', 'deskripsi_fitur', 'gambar_fitur', 'order_fitur', 'fitur_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
