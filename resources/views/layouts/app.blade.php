<!DOCTYPE html>
<html lang="uk">

<head>
    <title>@yield('page_title') | Портал</title>
</head>

<body>
    <div>
        @if (session('error'))
            <div style="color: red">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('home') }}">Головна</a>
        @guest
            <a href="{{ route('auth.login') }}">Вхід</a>
        @else
            <a href="{{ route('auth.logout') }}">Вихід</a>
        @endguest
    </div>
    @yield('content')
</body>

</html>