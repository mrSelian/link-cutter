<?php

namespace App\Http\Controllers;

use App\Http\Requests\QrGenerateRequest;
use App\Services\QrSavingService;
use Illuminate\Http\RedirectResponse;

class QrController extends Controller
{
    public function generate(QrGenerateRequest $request): RedirectResponse
    {
        $path = QrSavingService::saveQrFrom($request->origin)['download_path'];

        return redirect()
            ->route('qr_generator')
            ->with('success',
                'Ваш QR-code: ' . '<img src="' . $path . '">' .
                '<a href="' . $path . '" download="">Скачать</a>');
    }
}
