<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sertifikat
extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sertifikat';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pengajuan_id',
        'location',
    ];
}
