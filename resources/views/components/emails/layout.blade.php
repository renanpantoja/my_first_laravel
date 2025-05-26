<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? '' }}</title>
</head>
<body style="font-family: Arial, sans-serif;">

    <img width="200px" src="{{ Vite::asset('resources/images/logo.png') }}" alt="">

    <div style="text-align:center; margin-bottom:20px;">
        <img src="{{ asset('images/seu-logo.png') }}" alt="Logo" style="max-height: 50px;">
    </div>

    <div>
        {{ $slot }}
    </div>

    <div style="margin-top: 40px; font-size: 12px; color: #666; text-align: center;">
        &copy; {{ date('Y') }} My Jobs Plataforms.
    </div>
</body>
</html>
