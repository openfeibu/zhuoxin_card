<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\ResourceController as BaseController;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\EmployeeRepository;

class EmployeeResourceController extends BaseController
{
    /**
     * @var EmployeeService
     */
    private $employeeService;

    public function __construct(
        EmployeeService  $employeeService,
        EmployeeRepository $employee
    )
    {
        parent::__construct();
        $this->employeeService = $employeeService;
        $this->repository = $employee;
        $this->repository
            ->pushCriteria(\App\Repositories\Criteria\RequestCriteria::class);
    }
    public function index(Request $request)
    {
        $limit = $request->input('limit',config('app.limit'));
        if ($this->response->typeIs('json')) {
            $data = $this->repository
                ->orderBy('order','asc')
                ->orderBy('id','desc')
                ->paginate($limit);
            return $this->response
                ->success()
                ->count($data->total())
                ->data($data->toArray()['data'])
                ->output();
        }
        return $this->response->title(trans('employee.name'))
            ->view('employee.index')
            ->output();
    }
    public function create(Request $request)
    {
        $employee = $this->repository->newInstance([]);

        return $this->response->title(trans('employee.name'))
            ->view('employee.create')
            ->data(compact('employee'))
            ->output();
    }
    public function store(Request $request)
    {
        try {
            $attributes = $request->all();

            $employee = $this->repository->create($attributes);
            $employee->card_qrcode = $this->employeeService->generateQrCode($employee);

            $employee->save();

            return $this->response->message(trans('messages.success.created', ['Module' => trans('employee.name')]))
                ->code(0)
                ->status('success')
                ->url(guard_url('employee'))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('employee'))
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

        return $this->response->title(trans('app.view') . ' ' . trans('employee.name'))
            ->data(compact('employee'))
            ->view($view)
            ->output();
    }
    public function update(Request $request,Employee $employee)
    {
        try {
            $attributes = $request->all();

            $employee->update($attributes);
            $employee->card_qrcode = $this->employeeService->generateQrCode($employee);

            $employee->save();
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
