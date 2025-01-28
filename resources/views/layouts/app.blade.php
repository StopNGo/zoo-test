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
            <a href="{{ route('login') }}">Вхід</a>
        @else
            <a href="#" onclick="document.getElementById('logout-form').submit()">Вихід</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        @endguest
    </div>
    @yield('content')
</body>

</html>