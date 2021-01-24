<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GoogleController extends Controller
{
    public function generateSecretKey()
    {
        $google2fa = new Google2FA();

        // //esta es la llave de encriptacion que más adelante va a dar el código qr

        // $secretKey = $google2fa->generateSecretKey();

        // $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());

        // $inlineUrl = $google2fa->getQRCodeInline(
        //     'Company Name',
        //     'company@email.com',
        //     $google2fa->generateSecretKey()
        // );
    
        // return response()->json([
        //     'secret_key' => $secretKey,
        //     'url' => $inlineUrl
        // ], 200);

        $qrCode = QrCode::format('svg')
                            ->size(100)
                            ->generate($google2fa->getQRCodeUrl('PasuSewa', 'contact@pasusewa.com', $google2fa->generateSecretKey()));

        session()->put('credentials', [
            'key' => $google2fa->generateSecretKey(),
            'qr' => $qrCode
        ]);

        // dd($qrCode);

        // return response()->json([
        //     'key' => $google2fa->generateSecretKey(),
        //     'qr' => \QrCode::format('svg')
        //                     ->size(100)
        //                     ->generate($google2fa->getQRCodeUrl('$companyName', '$companyEmai', $google2fa->generateSecretKey())),
        // ], 200);
        return view('prueba', compact('google2fa', 'qrCode'));
    }

    public function velidateCode(Request $request)
    {
        $secret = $request->input('secret');

        $google2fa = new Google2FA();

        $window = 0; // el window hay que dejarlo en 0, para que asi solo tome los 30 segundos que dura el codigo
        // en un futuro habria que actualizarlo, ya que es posible que los relojes en el celular y/o el servidor se desfacen

        $valid = $google2fa->verifyKey('DCRMALCXPEZOFKZH', $secret, $window);

        dd($valid);
    }
}
