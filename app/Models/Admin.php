<?php

namespace App\Models;

use Zizaco\Entrust\Traits\EntrustUserTrait;

class Admin extends BaseModel
{
    use EntrustUserTrait;

    protected $hidden = [
        'extra',
        'password',
        'deleted_at',
    ];

    protected $appends = ['avatar'];

    protected $casts = [
        'extra' => 'array',
    ];

    public $statusLabel = [
        'ACTIVE' => '已激活',
        'INACTIVE' => '未激活',
    ];

    public function getAvatarAttribute()
    {
        return url(config('image.defaultImg'));
    }

    public function getIsSuperAttribute()
    {
        return (bool) in_array($this->username, config('admin.super'));
    }
}
