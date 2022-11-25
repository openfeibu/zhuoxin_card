<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\ResourceController as BaseController;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\SettingRepositoryInterface;
use App\Models\Setting;
use Tree;
/**
 * Resource controller class for page.
 */
class SettingResourceController extends BaseController
{
    /**
     * Initialize category resource controller.
     *
     * @param type SettingRepositoryInterface $setting
     *
     */
    public function __construct(SettingRepositoryInterface $setting)
    {
        parent::__construct();
        $this->repository = $setting;
        $this->repository
            ->pushCriteria(\App\Repositories\Criteria\RequestCriteria::class);
    }
    public function company(Request $request)
    {
        $company_params = $this->repository->where(['category' => 'company'])->get()->toArray();
        foreach ($company_params as $key => $param)
        {
            $company[$param['slug']] = $param['value'];
        }
        return $this->response->title('公司信息管理')
            ->view('setting.company')
            ->data(compact('company'))
            ->output();
    }
    public function updateCompany(Request $request)
    {
        try {
            $attributes = $request->all();
            foreach ($attributes as $key => $attribute)
            {
                Setting::where('slug',$key)->update(['value' => $attribute]);
            }
            return $this->response->message(trans('messages.success.created'))
                ->success()
                ->url(guard_url('setting/company'))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('setting/company'))
                ->redirect();
        }
    }
    public function station(Request $request)
    {
        $setting_params = $this->repository->where(['category' => 'station'])->get()->toArray();
        foreach ($setting_params as $key => $param)
        {
            if($param['type'] == 'text')
            {
                $setting[$param['slug']] = $param['value'];
            }else if($param['type'] == 'image'){
                $setting[$param['slug']] = $this->repository->find($param['id']);
            }

        }

        return $this->response->title('站点信息管理')
            ->view('setting.station')
            ->data(compact('setting'))
            ->output();
    }
    public function updateStation(Request $request)
    {
        try {
            $attributes = $request->all();
            foreach ($attributes as $key => $attribute)
            {
                Setting::where('slug',$key)->update(['value' => $attribute]);
            }
            return $this->response->message(trans('messages.success.created'))
                ->success()
                ->url(guard_url('setting/station'))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('setting/station'))
                ->redirect();
        }
    }
    public function publicityVideo(Request $request)
    {
        $video_params = $this->repository->where(['category' => 'publicity_video'])->get()->toArray();
        foreach ($video_params as $key => $param)
        {
            $video[$param['slug']] = $param['value'];
        }
        $video_poster = $this->repository->where(['slug' => 'video_poster'])->first();
        return $this->response->title('宣传视频管理')
            ->view('setting.video')
            ->data(compact('video','video_poster'))
            ->output();
    }
    public function updatePublicityVideo(Request $request)
    {
        try {
            $attributes = $request->all();
            foreach ($attributes as $key => $attribute)
            {
                Setting::where('slug',$key)->update(['value' => $attribute]);
            }
            return $this->response->message(trans('messages.success.created'))
                ->success()
                ->url(guard_url('setting/publicityVideo'))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('setting/publicityVideo'))
                ->redirect();
        }
    }

}