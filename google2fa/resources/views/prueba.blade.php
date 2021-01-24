<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>prueba 2fa</title>
</head>
<body>
    

    {{-- {!! QrCode::size(100)->generate($google2fa->getQRCodeUrl('$companyName', '$companyEmai', $google2fa->generateSecretKey())); !!} --}}
    {{-- {{dd(session()->get('credentials'))}} --}}

    <br><br><br>

    <form action="{{route('verify')}}" method="post">
        @csrf

        <input type="text" name="secret" id="secret">

        <input type="submit" value="enviar">
    </form>

</body>
</html>