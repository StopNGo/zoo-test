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
            <a href="{{ route('logout') }}" data-csrf="{{ csrf_token() }}" onclick="event.preventDefault(); 
                                fetch('{{ route('logout') }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': this.dataset.csrf
                                    }
                                }).then(() => window.location.reload());">
                Вихід
            </a>
        @endguest
    </div>
    @yield('content')
</body>

</html>