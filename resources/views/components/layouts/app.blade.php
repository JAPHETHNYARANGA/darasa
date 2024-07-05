<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Livewire Example</title>
    <livewire:styles />
    @livewireStyles
</head>
<body>
    <div class="container">
        {{ $slot }} <!-- This will render the Livewire component content -->
    </div>

    <livewire:scripts />
    @livewireScripts
</body>
</html>
