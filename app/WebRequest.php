<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebRequest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'request';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_request';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'api_key', 'username', 'host', 'ip_address', 'request_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
