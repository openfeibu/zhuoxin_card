<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\WXBizDataCryptService;
use App\Services\AmapService;
use Log;

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth.api');
        $this->user = User::getUser();
    }
    public function getUser(Request $request)
    {
        return $this->response->success()->data($this->user)->json();
    }
    public function submitPhone(Request $request)
    {
        $user = User::getUser();
        $encryptedData = $request->input('encryptedData');
        $iv = $request->input('iv');

        $WXBizDataCryptService = new WXBizDataCryptService($user['session_key']);

        $data = [];
        $errCode = $WXBizDataCryptService->decryptData($encryptedData, $iv, $data );

        if ($errCode != 0) {
            return response()->json([
                'code' => '400',
                'message' => $errCode,
            ]);
        }

        $phone_data = json_decode($data);

        $phone = $phone_data->phoneNumber;

        User::where('id',$user->id)->update([
            'phone' => $phone
        ]);
        return response()->json([
            'code' => '200',
            'message' => '提交成功',
            'data' => $phone
        ]);
    }
    public function submitLocation(Request $request)
    {
        $user = User::getUser();
        $longitude = $request->input('longitude','');
        $latitude =  $request->input('latitude','');
        $amap_service = new AmapService();

        $data = $amap_service->geocode_regeo($longitude.','.$latitude);

        User::where('id',$user->id)->update([
            'longitude' => $longitude,
            'latitude' => $latitude,
            'city' => $data['regeocode']['addressComponent']['city'],
        ]);

        return response()->json([
            'code' => '200',
            'message' => '提交成功',
            'data' => $data['regeocode']['addressComponent']['city'],
        ]);
    }


}
