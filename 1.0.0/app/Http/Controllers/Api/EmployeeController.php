<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Eloquent\EmployeeRepository;
use App\Repositories\Eloquent\JobCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Models\Page;

class EmployeeController extends BaseController
{
    /**
     * @var JobCategoryRepository
     */
    private $jobCategoryRepository;
    /**
     * @var EmployeeRepository
     */
    private $employeeRepository;

    public function __construct(
        JobCategoryRepository $jobCategoryRepository,
        EmployeeRepository $employeeRepository
    )
    {
        parent::__construct();
        $this->jobCategoryRepository = $jobCategoryRepository;
        $this->employeeRepository = $employeeRepository;
    }
    public function employees(Request $request)
    {
        $job_category_id = $request->get('job_category_id');
        $data = $this->employeeRepository
            ->when($job_category_id,function ($query) use($job_category_id){
                $query->where('job_category_id',$job_category_id);
            })
            ->orderBy('order','asc')
            ->orderBy('id','desc')
            ->paginate(20,['id','name','image']);
        foreach ($data as $key => $item)
        {
            $item['image'] = config('app.image_url').'/image/original'.$item['image'];
            $item['wechat_qrcode'] = config('app.image_url').'/image/original'.$item['wechat_qrcode'];
        }
        return $this->response
            ->success()
            ->count($data->total())
            ->data($data->toArray()['data'])
            ->json();
    }
    public function employee(Request $request, $id)
    {
        $employee = $this->employeeRepository
            ->find($id);
        if(!$employee)
        {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('数据不存在');
        }
        $employee->jobs;
        $employee['image'] = config('app.image_url').'/image/original'.$employee['image'];
        $employee['wechat_qrcode'] = config('app.image_url').'/image/original'.$employee['wechat_qrcode'];

        return $this->response->success()->data($employee->toArray())->json();
    }
    public function jobCategories(Request $request)
    {
        $data = $this->jobCategoryRepository->jobCategories();
        return $this->response
            ->success()
            ->data($data)
            ->json();
    }
}