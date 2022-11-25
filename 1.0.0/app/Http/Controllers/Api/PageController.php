<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Eloquent\PageCategoryRepositoryInterface;
use App\Repositories\Eloquent\PageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Models\Page;

class PageController extends BaseController
{
    public function __construct(PageRepository $page,
                                PageCategoryRepositoryInterface $category_repository)
    {
        parent::__construct();
        $this->repository = $page;
        $this->category_repository = $category_repository;
        $this->repository
            ->pushCriteria(\App\Repositories\Criteria\PageResourceCriteria::class);
    }
    public function getPages(Request $request)
    {
        $limit = $request->input('limit',config('app.limit'));
        $category_id = $request->input('category_id');
        $recommend_type =  $request->input('recommend_type');
        $all = $request->input('all');
        if(!$category_id){
            $cate_slug = $request->input('cate_slug');
            $category = $this->category_repository->where(['slug' => $cate_slug])->first(['id','name']);
            $category_id = $category->id;
        }

        $data = $this->repository->where(['status' => 'show']);

        $childs = $this->category_repository->where(['parent_id' => $category_id])->all(['id'])->toArray();
        if($childs){
            $child_ids = array_column($childs, 'id');
            $data = $data->whereIn('category_id' , $child_ids);
        }else{
            $data = $data->where(['category_id' => $category_id]);
        }
        if($recommend_type){
            $data = $data->where(['recommend_type' => $recommend_type]);
        }
        $category = $this->category_repository->find($category_id);
        $data = $data->orderBy('order','asc')->orderBy('id','desc')
            ->setPresenter(\App\Repositories\Presenter\Api\PageListPresenter::class);

        if($all){
            $data = $data->get();
        }else{
            $data = $data->getDataTable($limit);
        }
        return $this->response->success()->data($data['data'])->json();

    }
    public function getPage(Request $request, $id)
    {
        $page = $this->repository
            ->setPresenter(\App\Repositories\Presenter\Api\PageShowPresenter::class)
            ->where(['status' => 'show'])
            ->find($id);
        if(!$page)
        {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('数据不存在');
        }

        return $this->response->success()->data($page['data'])->json();

    }
    public function getPageSlug(Request $request,$slug)
    {
        $page = $this->repository
            ->setPresenter(\App\Repositories\Presenter\Api\PageShowPresenter::class)
            ->where(['status' => 'show','slug' => $slug])
            ->first();
        if(!$page)
        {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('数据不存在');
        }

        return $this->response->success()->data($page['data'])->json();
    }



}
