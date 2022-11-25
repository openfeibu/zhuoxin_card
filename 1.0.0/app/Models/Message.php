<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\BaseModel;
use App\Traits\Database\Slugger;
use App\Traits\Filer\Filer;
use App\Traits\Hashids\Hashids;
use App\Traits\Trans\Translatable;

class Message extends BaseModel
{
    use Filer, Hashids, Slugger, Translatable, LogsActivity;

    protected $config = 'model.message.message';

    protected $appends = ['admin_user_avatar'];

    public function getAdminUserAvatarAttribute()
    {
        return url('image/original'.setting('message_admin_user_avatar'));
    }

}