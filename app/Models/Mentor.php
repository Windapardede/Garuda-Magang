<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mentor
extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mentor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'nama',
        'posisi',
        'email',
        'password',
        'posisi_mentor',
        'posisi_id',
        'is_active',
    ];

    public function posisi()
    {
        return $this->belongsTo(Posisi::class, 'posisi_id', 'id');
    }
}
