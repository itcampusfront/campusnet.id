<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpdatePassword extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'update_password';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_up';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'old_password', 'new_password', 'up_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
