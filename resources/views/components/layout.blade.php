<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        {{ $title }}
    </title>
    @vite('resources/css/app.css')
</head>

<body>
    {{ $header }}
    <div class="p-1">
        {{ $slot }}
    </div>
</body>

</html>
