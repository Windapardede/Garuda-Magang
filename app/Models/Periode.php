<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periode
extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'periode';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'tanggal_pengajuan',
        'tanggal_selesai',
        'is_active',
    ];


    public function periode()
    {
        return $this->belongsTo(Periode::class, 'jenis_buku', 'id');
    }
}
