@extends('layouts.app')

@section('page_title', 'Повідомлення')

@section('content')
@auth
    <h3>Зробити нове повідомлення</h3>
    <form action="{{ url('/messages') }}" method="POST">
        @csrf
        <input type="text" name="content" placeholder="Написати повідомлення..." required>
        <button type="submit">Відправити</button>
    </form>
@endauth

<h3>Всі повідомлення</h3>
@foreach ($messages as $message)
    <div class="message">
        <strong>{{ $message->created_at }}:</strong>
        <span id="message-content-{{ $message->id }}">{{ $message->content }}</span>

        @if (Auth::id() === $message->user_id)
            <button onclick="showEditForm({{ $message->id }})">Редагувати</button>
            <form id="edit-form-{{ $message->id }}" action="{{ url('/messages/' . $message->id) }}" method="POST"
                style="display:none;">
                @csrf @method('PUT')
                <input type="text" name="content" value="{{ $message->content }}" required>
                <button type="submit">Оновити</button>
                <button type="button" onclick="hideEditForm({{ $message->id }})">Відмінити</button>
            </form>
            <form action="{{ url('/messages/' . $message->id) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" onclick="return confirm('Ви впевнені?')">Видалити</button>
            </form>
        @endif
    </div>
@endforeach

<script>
    function showEditForm(id) {
        document.getElementById('message-content-' + id).style.display = 'none';
        document.getElementById('edit-form-' + id).style.display = 'block';
    }

    function hideEditForm(id) {
        document.getElementById('message-content-' + id).style.display = 'inline';
        document.getElementById('edit-form-' + id).style.display = 'none';
    }
</script>
@endsection