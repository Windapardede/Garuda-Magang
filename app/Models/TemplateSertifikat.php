<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateSertifikat
extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'template_sertifikat';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_template_sertifikat',
        'file',
    ];
}
