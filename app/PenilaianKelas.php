<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenilaianKelas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'penilaian_kelas';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_pk';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'id_kelas', 'rating', 'review', 'pk_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
