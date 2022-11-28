<?php
namespace App\Services;

use Log;
use File;
use Storage;
use Endroid\QrCode\QrCode;

class EmployeeService{

    private $size = 400;
    private $file_folder = 'qrcode';
    protected $qrcode_url = '';
    protected $file;

    public function generateQrCode($employee)
    {
        $directory = '/'.$this->file_folder.'/'.$employee['id'];
        $logo_path = $employee['image'] ? storage_path('uploads').'/'.$employee['image'] : storage_path('uploads').'/codelogo.jpg';

        $image_name = $this->size.'-'.md5($this->qrcode_url).'.png';
        $this->file = storage_path('uploads').$directory.DIRECTORY_SEPARATOR.$image_name;

        if(!file_exists($this->file)) {
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory, 0755, true);
            }
            $qrCode = new QrCode($this->qrcode_url);
            $qrCode->setWriterByName('png');
            $qrCode->setSize($this->size);
            $qrCode->setMargin(1);
            $qrCode->setLogoPath($logo_path,0.2,true);
            $qrCode->setLogoSize(60, 60);
            $qrCode->setEncoding('UTF-8');
            $qrCode->setRoundBlockSize(true);
            $qrCode->setValidateResult(false);
            $qrCode->writeFile($this->file);
        }
        return '/'.$this->file_folder.'/'.$employee['id'].'/'.$image_name;
    }
}