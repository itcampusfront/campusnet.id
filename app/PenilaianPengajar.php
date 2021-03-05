<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenilaianPengajar extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'penilaian_pengajar';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_pp';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'id_kelas', 'id_pengajar', 'rating', 'review', 'pp_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
