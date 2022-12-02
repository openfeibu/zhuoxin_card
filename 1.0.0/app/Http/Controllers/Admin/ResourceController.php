<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use App\Models\PageView;
use App\Models\User;
use Route;
use App\Http\Controllers\Admin\Controller as BaseController;
use App\Traits\AdminUser\AdminUserPages;
use App\Http\Response\ResourceResponse;
use App\Traits\Theme\ThemeAndViews;
use App\Traits\AdminUser\RoutesAndGuards;

class ResourceController extends BaseController
{
    use AdminUserPages,ThemeAndViews,RoutesAndGuards;

    public function __construct()
    {
        parent::__construct();
        if (!empty(app('auth')->getDefaultDriver())) {
            $this->middleware('auth:' . app('auth')->getDefaultDriver());
           // $this->middleware('role:' . $this->getGuardRoute());
            $this->middleware('permission:' .Route::currentRouteName());
            $this->middleware('active');
        }
        $this->response = app(ResourceResponse::class);
        $this->setTheme();
    }
    /**
     * Show dashboard for each user.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        //当日名片浏览量、当日新增用户数量、名片的总浏览量、律师名片数量、用户总数量

        $user_count = User::count();
        $today_user_count = User::where('created_at','>=',date('Y-m-d 00:00:00'))->count();
        $employee_count = Employee::count();
        $employee_view_count = PageView::where('pageable_type',config('model.job.employee.model'))->count();
        $today_employee_view_count = PageView::where('pageable_type',config('model.job.employee.model'))->where('created_at','>=',date('Y-m-d 00:00:00'))->count();

        return $this->response->title(trans('app.admin.panel'))
            ->data(compact('user_count','today_user_count','employee_count','employee_view_count','today_employee_view_count'))
            ->view('home')
            ->output();
    }
    public function dashboard()
    {
        return $this->response->title('测试')
            ->view('dashboard')
            ->output();
    }
}
