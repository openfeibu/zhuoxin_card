<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\ResourceController as BaseController;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\JobRepository;

class JobResourceController extends BaseController
{
    public function __construct(JobRepository $job)
    {
        parent::__construct();
        $this->repository = $job;
        $this->repository
            ->pushCriteria(\App\Repositories\Criteria\RequestCriteria::class);
    }
    public function index(Request $request)
    {
        $limit = $request->input('limit',config('app.limit'));
        if ($this->response->typeIs('json')) {
            $data = $this->repository
                ->orderBy('order','asc')
                ->orderBy('id','asc')
                ->paginate($limit);
            return $this->response
                ->success()
                ->count($data->total())
                ->data($data->toArray()['data'])
                ->output();
        }
        return $this->response->title(trans('job.name'))
            ->view('job.index')
            ->output();
    }
    public function create(Request $request)
    {
        $job = $this->repository->newInstance([]);

        return $this->response->title(trans('job.name'))
            ->view('job.create')
            ->data(compact('job'))
            ->output();
    }
    public function store(Request $request)
    {
        try {
            $attributes = $request->all();

            $job = $this->repository->create($attributes);

            return $this->response->message(trans('messages.success.created', ['Module' => trans('job.name')]))
                ->code(0)
                ->status('success')
                ->url(guard_url('job'))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('job'))
                ->redirect();
        }
    }
    public function show(Request $request,Job $job)
    {
        if ($job->exists) {
            $view = 'job.show';
        } else {
            $view = 'job.create';
        }

        return $this->response->title(trans('app.view') . ' ' . trans('job.name'))
            ->data(compact('job'))
            ->view($view)
            ->output();
    }
    public function update(Request $request,Job $job)
    {
        try {
            $attributes = $request->all();

            $job->update($attributes);

            return $this->response->message(trans('messages.success.updated', ['Module' => trans('job.name')]))
                ->code(0)
                ->status('success')
                ->url(guard_url('job'))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('job/' . $job->id))
                ->redirect();
        }
    }
    public function destroy(Request $request,Job $job)
    {
        try {
            $this->repository->forceDelete([$job->id]);

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('job.name')]))
                ->status("success")
                ->http_code(202)
                ->url(guard_url('job'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->status("error")
                ->code(400)
                ->url(guard_url('job'))
                ->redirect();
        }
    }
    public function destroyAll(Request $request)
    {
        try {
            $data = $request->all();
            $ids = $data['ids'];
            $this->repository->forceDelete($ids);

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('job.name')]))
                ->status("success")
                ->http_code(202)
                ->url(guard_url('job'))
                ->redirect();

        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->status("error")
                ->code(400)
                ->url(guard_url('job'))
                ->redirect();
        }
    }
}
