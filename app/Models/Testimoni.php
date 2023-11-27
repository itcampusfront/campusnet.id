<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'testimoni';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_testimoni';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'klien', 'ucapan_testimoni', 'order_testimoni', 'testimoni_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
