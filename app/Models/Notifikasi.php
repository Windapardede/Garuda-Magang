<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi
extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notification';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'subtitle',
        'is_viewed',
        'is_active',
    ];
}
