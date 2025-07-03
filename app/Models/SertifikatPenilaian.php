<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SertifikatPenilaian
extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jurusan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
    ];
}
