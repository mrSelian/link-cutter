<?php

namespace App\Services;

use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrSavingService
{
    static function saveQrFrom($origin): array
    {
        $picId = rand(10000, 9999999999999);

        $path = '../public/images/qr/tmp/pic' . $picId . '.png';
        $downloadPath = URL::to('/') . '/images/qr/tmp/pic' . $picId . '.png';

        QrCode::encoding('UTF-8')->format('png')->backgroundColor(255, 255, 255)->size(250)->margin(1)->generate($origin, $path);

        return [
            'download_path' => $downloadPath,
            'path' => $path
        ];
    }

}
