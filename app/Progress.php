<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'progress';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_progress';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'id_konten', 'progress', 'progress_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
