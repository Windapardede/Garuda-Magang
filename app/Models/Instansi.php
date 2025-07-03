<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instansi
extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'instansi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'nama',
        'kuota',
        'kuota_tersedia',
        'is_active',
    ];
}
