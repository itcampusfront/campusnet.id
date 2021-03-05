<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topik extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'topik';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_topik';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_kelas', 'nama_topik', 'topik_order', 'topik_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
