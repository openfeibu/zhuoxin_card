<?php
namespace App\Services;

use App\Exceptions\OutputServerMessageException;
use Log;
use File;
use Storage;
use Endroid\QrCode\QrCode;
use EasyWeChat\Factory;

class EmployeeService{

    private $size = 400;
    private $file_folder = 'qrcode';
    protected $qrcode_url = 'https://apizhuoxincard.feibu.info?type=weapp';
    protected $file;
    /*
    public function generateQrCode($employee)
    {
        $directory = '/'.$this->file_folder.'/'.$employee['id'];
        $logo_path = $employee['image'] ? storage_path('uploads').'/'.$employee['image'] : storage_path('uploads').'/codelogo.jpg';

        $image_name = $this->size.'-'.md5($this->qrcode_url.$logo_path).'.png';
        $this->file = storage_path('uploads').$directory.DIRECTORY_SEPARATOR.$image_name;
        $qrcode_url = $this->qrcode_url . '';
        if(!file_exists($this->file)) {
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory, 0755, true);
            }
            $qrCode = new QrCode($qrcode_url);
            $qrCode->setWriterByName('png');
            $qrCode->setSize($this->size);
            $qrCode->setMargin(1);
            //$qrCode->setLogoPath($logo_path,0.2,true);
            $qrCode->setLogoSize(60, 60);
            $qrCode->setEncoding('UTF-8');
            $qrCode->setRoundBlockSize(true);
            $qrCode->setValidateResult(false);
            $qrCode->writeFile($this->file);
        }
        return '/'.$this->file_folder.'/'.$employee['id'].'/'.$image_name;
    }
      */

    public function generateQrCode($employee){
       // if(!$employee['card_qrcode']){
            $config = [
                'app_id' => config('wechat.mini_program.default.app_id'),
                'secret' =>  config('wechat.mini_program.default.secret'),

            ];
            $app = Factory::miniProgram($config);

            $response = $app->app_code->getUnlimit('id='.$employee['id'], [
                'page'  => 'pages/professionalsDetail/professionalsDetail',
                'width' => 600,
            ]);
// $response 成功时为 EasyWeChat\Kernel\Http\StreamResponse 实例，失败为数组或你指定的 API 返回类型

// 保存小程序码到文件
            $directory = DIRECTORY_SEPARATOR.$this->file_folder.DIRECTORY_SEPARATOR.$employee['id'];

            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory, 0755, true);
            }

            if ($response instanceof \EasyWeChat\Kernel\Http\StreamResponse) {
                $filename = $response->save(storage_path('uploads').$directory);
                return '/'.$this->file_folder.'/'.$employee['id'].'/'.$filename;

            }else{
                throw new OutputServerMessageException('生成名片二维码失败！'.'errcode：'.$response['errcode'].'；errmsg:'.$response['errmsg']);
            }

       // }
    }

}