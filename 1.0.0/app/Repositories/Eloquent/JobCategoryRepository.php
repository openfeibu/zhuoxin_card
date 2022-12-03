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
    public function getCategoriesSelectTree($parent_id=0,$check_ids=[])
    {

        $data = [];
        $categories = $this->where('parent_id',$parent_id)->orderBy('order','desc')->orderBy('id','asc')->get();
        foreach ($categories as $key => $category)
        {
            $data[$key] = [
                'title' => $category->name,
                'label' => $category->name,
                'id' => $category->id,
                'parent_id' => $category->parent_id,
                'order' => $category->order,
                'spread' => true,
                'checked' => false,
            ];
            if(!$this->where('parent_id',$category->id)->first(['id']))
            {
                $data[$key]['checked'] = in_array($category->id,$check_ids);
            }
            $data[$key]['children'] = $this->getCategoriesSelectTree($category->id,$check_ids);
        }
        return $data;
    }
    public function getSubIds($category_id=0,$sub_ids=[]){
        $ids = $this->where('parent_id',$category_id)->pluck('id')->toArray();
        $sub_ids = array_merge($sub_ids,$ids);
        foreach ($ids as $key=> $id)
        {
            $sub_ids = $this->getSubIds($id,$sub_ids);
        }
        return $sub_ids;
    }
}
