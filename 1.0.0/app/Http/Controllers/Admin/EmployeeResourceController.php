<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\ResourceController as BaseController;
use App\Models\Employee;
use App\Repositories\Eloquent\JobCategoryRepository;
use App\Repositories\Eloquent\JobRepository;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\EmployeeRepository;
use DB,Tree;

class EmployeeResourceController extends BaseController
{
    /**
     * @var EmployeeService
     */
    private $employeeService;
    /**
     * @var JobRepository
     */
    private $jobRepository;
    /**
     * @var JobCategoryRepository
     */
    private $jobCategoryRepository;

    public function __construct(
        EmployeeService  $employeeService,
        EmployeeRepository $employee,
        JobRepository $jobRepository,
        JobCategoryRepository $jobCategoryRepository
    )
    {
        parent::__construct();
        $this->employeeService = $employeeService;
        $this->repository = $employee;
        $this->jobRepository = $jobRepository;
        $this->jobCategoryRepository = $jobCategoryRepository;
        $this->repository
            ->pushCriteria(\App\Repositories\Criteria\RequestCriteria::class);
    }
    public function index(Request $request)
    {
        $limit = $request->input('limit',config('app.limit'));
        $search = $request->get('search',[]);
        if ($this->response->typeIs('json')) {
            $data = $this->repository->join('job_categories','employees.job_category_id','=','job_categories.id')
                ->when($search ,function ($query) use ($search){
                    foreach($search as $field => $value)
                    {
                        if($value)
                        {
                            if($field == 'job_category_id')
                            {
                                $query->where(function ($query) use ($value){
                                    $ids = $this->jobCategoryRepository->getSubIds($value);
                                    array_unshift($ids,$value);
                                    $query->whereIn('job_category_id',$ids);
                                });
                            }else{

                                $query->where('employees.'.$field,'like','%'.$value.'%');

                            }
                        }
                    }
                })
                ->orderBy('order','asc')
                ->orderBy('id','desc')
                ->paginate($limit,['employees.*','job_categories.name as job_category_name']);
            foreach ($data as $item)
            {
                $item->job_names = $item->jobs()->pluck('name');
            }
            return $this->response
                ->success()
                ->count($data->total())
                ->data($data->toArray()['data'])
                ->output();
        }
        $jobs = $this->jobRepository->getALL();
        return $this->response->title(trans('employee.name'))
            ->view('employee.index')
            ->data(compact('jobs'))
            ->output();
    }
    public function create(Request $request)
    {
        $employee = $this->repository->newInstance([]);
        $job_categories = $this->jobCategoryRepository->allJobCategories()->toArray();
        $job_categories = Tree::getSameLevelWithSignTree($job_categories);

        $jobs = $this->jobRepository->getALL();
        return $this->response->title(trans('employee.name'))
            ->view('employee.create')
            ->data(compact('employee','job_categories','jobs'))
            ->output();
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $attributes = $request->all();
            var_dump($attributes);exit;
            $employee = $this->repository->create($attributes);
            $employee->card_qrcode = $this->employeeService->generateQrCode($employee);

            $employee->save();
            $jobs = $request->get('jobs');
            $employee->jobs()->sync($jobs);
            DB::commit();

            return $this->response->message(trans('messages.success.created', ['Module' => trans('employee.name')]))
                ->code(0)
                ->status('success')
                ->url(guard_url('employee'))
                ->redirect();
        } catch (Exception $e) {

            DB::rollBack();
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('employee/create'))
                ->redirect();
        }
    }
    public function show(Request $request,Employee $employee)
    {
        if ($employee->exists) {
            $view = 'employee.show';
        } else {
            $view = 'employee.create';
        }
        $job_categories = $this->jobCategoryRepository->allJobCategories()->toArray();
        $job_categories = Tree::getSameLevelWithSignTree($job_categories);
        $jobs = $this->jobRepository->getALL();

        return $this->response->title(trans('app.view') . ' ' . trans('employee.name'))
            ->data(compact('employee','job_categories','jobs'))
            ->view($view)
            ->output();
    }
    public function update(Request $request,Employee $employee)
    {
        try {
            $attributes = $request->all();

            $employee->update($attributes);
            if(!$employee['card_qrcode']){
                $employee->card_qrcode = $this->employeeService->generateQrCode($employee);

                $employee->save();
            }


            $jobs = $request->get('jobs');
            $employee->jobs()->sync($jobs);

            return $this->response->message(trans('messages.success.updated', ['Module' => trans('employee.name')]))
                ->code(0)
                ->status('success')
                ->url(guard_url('employee'))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('employee/' . $employee->id))
                ->redirect();
        }
    }
    public function destroy(Request $request,Employee $employee)
    {
        try {
            $this->repository->forceDelete([$employee->id]);

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('employee.name')]))
                ->status("success")
                ->http_code(202)
                ->url(guard_url('employee'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->status("error")
                ->code(400)
                ->url(guard_url('employee'))
                ->redirect();
        }
    }
    public function destroyAll(Request $request)
    {
        try {
            $data = $request->all();
            $ids = $data['ids'];
            $this->repository->forceDelete($ids);

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('employee.name')]))
                ->status("success")
                ->http_code(202)
                ->url(guard_url('employee'))
                ->redirect();

        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->status("error")
                ->code(400)
                ->url(guard_url('employee'))
                ->redirect();
        }
    }
}
