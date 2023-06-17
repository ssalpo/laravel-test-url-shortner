<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test project</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>

<div>
    <div>
        <input type="text" placeholder="Enter url" class="js-url-input" />
        <button type="button" class="js-url-btn">сократить</button>
    </div>

    <ul class="errors"></ul>
</div>

<ul style="margin-top: 20px" class="js-last-short-urls"></ul>

</body>
</html>
