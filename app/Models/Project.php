<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'project';

    protected $fillable = [
        'user_id',
        'pengajuan_id',
        'detail_id',
        'title',
        'jenis',
    ];

    public function nama()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function pengajuan()
    {
        return $this->belongsTo(User::class, 'pengajuan_id', 'id');
    }
    public function Detail()
    {
        return $this->belongsTo(User::class, 'detail_id', 'id');
    }

    public function detailProjects()
    {
        return $this->hasMany(DetailProject::class, 'project_id', 'id');
    }


}
