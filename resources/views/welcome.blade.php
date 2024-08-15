<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') ?? 'Tourism-Info-App' }}</title>
    @vite('resources/css/app.css')
</head>
<body>
<div id="app">
    <tourism-info></tourism-info>
</div>
@vite('resources/js/app.js')
</body>
</html>
