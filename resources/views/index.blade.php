<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Портал</title>
</head>

<body>
    @extends('layouts.app')

    @section('page_title', 'Головна')

    @section('content')
    @auth
        <form action="{{ url('/messages') }}" method="POST">
            @csrf
            <input type="text" name="content" placeholder="Type your message..." required>
            <button type="submit">Відправити</button>
        </form>
    @endauth

    <h3>Всі повідомлення</h3>
    @foreach ($messages as $message)
        <div>
            <strong>{{ $message->user->name }}:</strong> {{ $message->content }}
            @if (Auth::id() === $message->user_id)
                <form action="{{ url('/messages/' . $message->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit">Видалити</button>
                </form>
            @endif
        </div>
    @endforeach
    @endsection
</body>

</html>