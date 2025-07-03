<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = 'soal_kemampuan';

    protected $fillable = [
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'soal',
    ];
}
