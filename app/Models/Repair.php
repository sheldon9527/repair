<?php

namespace App\Models;

use App\Traits\Attachment as AttachmentTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repair extends BaseModel
{
    use SoftDeletes, AttachmentTrait;

    protected $hidden = [
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'phone',
        'description',
        'status',
    ];

    public function attachments()
    {
        return $this->morphMany('App\Models\Attachment', 'attachable');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category')->withTimestamps();
    }

    public function dorm()
    {
         return $this->hasOne('App\Models\Dorm', 'id', 'dorm_id');
    }
}
