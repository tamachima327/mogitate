<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mea+Culpa&display=swap" rel="stylesheet">
    @stack('css')
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="header__title">mogitate</h1>
        </div>
    </header>
    <main class="main">
        <div class="main__inner">
            @yield('content')
        </div>
    </main>
</body>
</html>
