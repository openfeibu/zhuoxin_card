<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\NavRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use Route;

class JobCategoryRepository extends BaseRepository implements JobCategoryRepositoryInterface
{

    /**
     * Booting the repository.
     *
     * @return null
     */
    public function boot()
    {
        $this->fieldSearchable = config('model.job.category.search');
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('model.job.category.model');
    }
    public function tops()
    {
        return $this->where(['parent_id' => 0,'show' => 1])->orderBy('order','asc')->orderBy('id','asc')->get();
    }

    public function topParent($id)
    {
        $job_category = $this->where(['id' => $id])->first();
        if($job_category->parent_id)
        {
            return $this->topParent($job_category->parent_id);
        }
        return $job_category;
    }
    public function children($parent_id)
    {
        return $this->where(['parent_id' => $parent_id,'show' => 1])->orderBy('order','asc')->orderBy('id','asc')->get();
    }
    public function allJobCategories()
    {
        return $this->where(['show' => 1])->orderBy('order','asc')->orderBy('id','asc')->get();
    }
    /**
     * Permission Menus
     * @return array
     */
    public function jobCategories()
    {
        $father = $this->tops()->toArray();

        if($father) {
            foreach ($father as $key => $item) {
                $father[$key]['sub'] = $this->sub($item);
            }
        }

        return $father;
    }
    public function sub($item)
    {
        $subs = $this->children($item['id'])->toArray();
        if($subs)
        {
            foreach ($subs as $key => $sub) {
                $subs[$key]['sub'] = $this->sub($sub);
            }
        }
        return $subs;
    }
    public function jobCategoryList($id,$list=[])
    {
        $job_category = $this->model->where('id',$id)->first();
        if(!$job_category)
        {
            return $list;
        }
        array_unshift($list,$job_category->toArray());
        if($job_category->parent_id)
        {
            return $this->jobCategoryList($job_category->parent_id,$list);
        }
        return $list;
    }
    public function jobCategoryTab($parent_id)
    {
        return $this->children($parent_id);
    }

}
