<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\BaseModel;
use App\Traits\Database\Slugger;
use App\Traits\Filer\Filer;
use App\Traits\Hashids\Hashids;
use App\Traits\Trans\Translatable;

class Employee extends BaseModel
{
    use Filer, Hashids, Slugger, Translatable, LogsActivity;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'model.job.employee';
    /**
     * @var mixed
     */
    protected $jobs;

    /**
     * User belongs to many jobs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jobs()
    {
        return $this->belongsToMany(config('model.job.job.model'));
    }
    public function hasJob($job_id)
    {
        return $this->getJobs()->contains(function ($value, $key) use ($job_id) {
            return $job_id == $value->id;
        });
    }
    public function getJobs()
    {
        return (!$this->jobs) ? $this->jobs = $this->jobs()->get() : $this->jobs;
    }
    /**
     * 获得此文章的所有评论。
     */
    public function page_views()
    {
        return $this->morphMany(config('model.page_view.page_view.model'), 'pageable');
    }

}