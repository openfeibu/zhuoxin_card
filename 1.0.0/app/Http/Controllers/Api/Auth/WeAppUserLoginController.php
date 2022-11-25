<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\OutputServerMessageException;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Models\User;
use \GuzzleHttp\Client;
use Log;
use App\Helpers\Constants as Constants;
use App\Services\WXBizDataCryptService;

class WeAppUserLoginController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function code(Request $request)
    {
        $code = $request->input('code');
        $we_data =  $this->getSessionKey($code);
        $token = $this->generatetoken($we_data['session_key']);
        $user_info = (object)Array();
        $user_info->openId = $we_data['openid'];
        $user_info->avatarUrl = '';
        $user_info->nickName = '';
        $user_info->city = "";
        //$this->storeUser($user_info, $token, $we_data['session_key']);
        $user = app(User::class)->findUserByOpenId($user_info->openId);

        return $this->response->success()->data($user)->json();

    }
    //wx.getUserProfile 获取opedId，没有真实昵称，由前端提供$rawData
    public function login(Request $request)
    {
        $code = $request->input('code');
        $encryptedData = $request->input('encryptedData');
        $iv = $request->input('iv');
        $raw_data = json_decode($request->input('rawData'),true);

        $data = $this->getSessionKey($code);
        $sessionKey = $data['session_key'];

        $token = $this->generatetoken($sessionKey);

        $WXBizDataCryptService = new WXBizDataCryptService($sessionKey);

        $errCode = $WXBizDataCryptService->decryptData($encryptedData, $iv, $data );

        if ($errCode != 0) {
            throw new OutputServerMessageException($errCode);
        }

        $user_info = json_decode($data);
        $user_info->nickName = $raw_data['nickName'];
        $user_info->avatarUrl = $raw_data['avatarUrl'];
        $user_info->city = $raw_data['city'];

        $this->storeUser($user_info, $token, $sessionKey);

        $user = app(User::class)->findUserByToken($token);

        return $this->response->success()->data($user)->json();
    }
    //wx.getUserInfo 真实昵称，没有openId
    /*
    public function update(Request $request)
    {
        $code = $request->input('code');
        $encryptedData = $request->input('encryptedData');
        $iv = $request->input('iv');

        $data = $this->getSessionKey($code);
        $sessionKey = $data['session_key'];

        $token = $this->generatetoken($sessionKey);

        $WXBizDataCryptService = new WXBizDataCryptService($sessionKey);

        $errCode = $WXBizDataCryptService->decryptData($encryptedData, $iv, $data );

        if ($errCode != 0) {
            throw new OutputServerMessageException($errCode);
        }

        $user_info = json_decode($data);

        $this->storeUser($user_info, $token, $sessionKey);

        $user = app(User::class)->findUserByToken($token);

        return $this->response->success()->data($user)->json();
    }
    */
    /**
     * 通过 code 换取 session key
     * @param string $code
     * @return string $session_key
     * @throws \Exception
     */
    public function getSessionKey($code)
    {
        $appId = config("weapp.appid");
        $appSecret = config("weapp.secret");
        list($session_key, $openid) = array_values($this->getSessionKeyDirectly($appId, $appSecret, $code));
        return [
            'session_key' => $session_key,
            'openid' => $openid
        ];
    }
    /**
     * 直接请求微信获取 session key
     * @param string $appId
     * @param string $appSecret
     * @param string $code
     * @return array { $session_key, $openid }
     * @throws \Exception
     */
    private function getSessionKeyDirectly($appId, $appSecret, $code)
    {
        $requestParams = [
            'appid' => $appId,
            'secret' => $appSecret,
            'js_code' => $code,
            'grant_type' => 'authorization_code'
        ];
        $client = new Client();
        $url = config('weapp.code2session_url') . http_build_query($requestParams);
        $res = $client->request("GET", $url, [
            'timeout' => Constants::getNetworkTimeout()
        ]);
        $status = $res->getStatusCode();
        $body = json_decode($res->getBody(), true);

        if ($status !== 200 || !$body || isset($body['errcode'])) {
            throw new \App\Exceptions\OutputServerMessageException(Constants::E_LOGIN_FAILED);
        }
        return $body;
    }
    public function generatetoken($sessionKey)
    {
        $this->token = sha1($sessionKey . mt_rand());
        return $this->token;
    }

    public function storeUser($user_info, $token, $session_key)
    {
        $open_id = $user_info->openId;
        $res = User::where('open_id', $open_id)->first();
        if (isset($res) && $res) {
            User::where('open_id', $open_id)->update([
                'avatar_url' => isset($user_info->avatarUrl) && !empty($user_info->avatarUrl) ? $user_info->avatarUrl : $res->avatar_url,
                'nickname' => isset($user_info->nickName) && !empty($user_info->nickName) ? $user_info->nickName : $res->nickname,
                'token' => $token,
                'session_key' => $session_key,
                'city' => isset($user_info->city) && !empty($user_info->city) ? $user_info->city : $res->city,
            ]);
        } else {
            User::create([
                'open_id' => $user_info->openId,
                'avatar_url' => $user_info->avatarUrl,
                'nickname' => $user_info->nickName,
                'session_key' => $session_key,
                'token' => $token,
                'city' => $user_info->city,
            ]);
        }
    }

}
