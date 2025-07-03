<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailProject extends Model
{
    protected $table = 'detail_project';

    protected $fillable = [
        'project_id',
        'deskripsi',
        'status',
        'persentasi',
        'revisi',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
