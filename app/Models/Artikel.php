<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'artikel';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_artikel';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'judul_artikel', 'slug_artikel', 'gambar_artikel', 'kategori_artikel', 'tag_artikel', 'author_artikel', 'kontributor_artikel', 'konten_artikel', 'artikel_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
