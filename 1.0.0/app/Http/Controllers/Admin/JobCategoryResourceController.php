<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\ResourceController as BaseController;
use Illuminate\Http\Request;
use App\Models\JobCategory;
use App\Repositories\Eloquent\JobCategoryRepository;
use Tree;

/**
 * Resource controller class for page.
 */
class JobCategoryResourceController extends BaseController
{

    /**
     * Initialize page resource controller.
     *
     * @param JobCategoryRepository $job_category
     *
     */
    public function __construct(JobCategoryRepository $job_category)
    {
        parent::__construct();
        $this->repository = $job_category;
        $this->repository
            ->pushCriteria(\App\Repositories\Criteria\RequestCriteria::class)
            ->pushCriteria(\App\Repositories\Criteria\PageResourceCriteria::class);
    }

    /**
     * Display a list of page.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($this->response->typeIs('json')) {
            $data = $this->repository->allJobCategories()->toArray();
            $data = Tree::getSameLevelWithSignTree($data);
            return $this->response
                ->success()
                ->data($data)
                ->output();
        }
        return $this->response->title(trans('job_category.names'))
            ->view('job_category.index', true)
            ->output();
    }

    /**
     * Display page.
     *
     * @param Request $request
     * @param JobCategory   $job_category
     *
     * @return Response
     */
    public function show(Request $request, JobCategory $job_category)
    {
        if ($job_category->exists) {
            $view = 'job_category.show';
        } else {
            $view = 'job_category.new';
        }
        $tops = $this->repository->tops();
        return $this->response->title(trans('app.view') . ' ' . trans('job_category.name'))
            ->data(compact('job_category','tops'))
            ->view($view,true)
            ->output();
    }

    /**
     * Show the form for creating a new page.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(Request $request)
    {

        $job_category = $this->repository->newInstance([]);
        $tops = $this->repository->tops();
        return $this->response->title(trans('app.new') . ' ' . trans('job_category.name'))
            ->view('job_category.create', true)
            ->data(compact('job_category','tops'))
            ->output();
    }

    /**
     * Create new page.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $attributes = $request->all();
            $job_category = $this->repository->create($attributes);

            return $this->response->message(trans('messages.success.created', ['Module' => trans('job_category.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('job_category'))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('job_category'))
                ->redirect();
        }

    }

    /**
     * Show page for editing.
     *
     * @param Request $request
     * @param JobCategory   $job_category
     *
     * @return Response
     */
    public function edit(Request $request, JobCategory $job_category)
    {
        return $this->response->title(trans('app.edit') . ' ' . trans('job_category.name'))
            ->view('admin.page.edit')
            ->data(compact('job_category'))
            ->output();
    }

    /**
     * Update the page.
     *
     * @param Request $request
     * @param JobCategory   $job_category
     *
     * @return Response
     */
    public function update(Request $request, JobCategory $job_category)
    {
        try {
            $attributes = $request->all();

            $job_category->update($attributes);
            return $this->response->message(trans('messages.success.updated', ['Module' => trans('job_category.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('job_category'))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('job_category/' . $job_category->id))
                ->redirect();
        }

    }

    /**
     * Remove the page.
     *
     * @param Request $request
     * @param JobCategory   $job_category
     *
     * @return Response
     */
    public function destroy(Request $request,JobCategory $job_category)
    {
        try {
            $this->repository->forceDelete([$job_category->id]);

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('job_category.name')]))
                ->status("success")
                ->code(202)
                ->url(guard_url('job_category'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->status("error")
                ->code(400)
                ->url(guard_url('job_category'))
                ->redirect();
        }
    }
    public function destroyAll(Request $request)
    {
        try {
            $data = $request->all();
            $ids = $data['ids'];
            $this->repository->forceDelete($ids);

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('job_category.name')]))
                ->status("success")
                ->code(202)
                ->url(guard_url('job_category'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->status("error")
                ->code(400)
                ->url(guard_url('job_category'))
                ->redirect();
        }
    }
}