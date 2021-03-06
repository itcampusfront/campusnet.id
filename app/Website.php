<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_website';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'website_key', 'website_url', 'website_status', 'website_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
