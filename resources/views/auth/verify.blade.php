@extends('layouts.app')

@section('page_title', 'Верифікація')

@section('content')
<div class="verification-container">
    <p>Введіть код, надісланий на {{ $phone }}</p>
    <form action="{{ url('/login') }}" method="POST">
        @csrf
        <input type="hidden" name="phone" value="{{ $phone }}">
        <input type="text" name="code" placeholder="Введіть код" required>
        <button type="submit">Підтвердити</button>

        @if(isset($mock_code))
            <div class="mock-notice">
                <p><strong>Тестовий режим:</strong> Використовуйте код <code>{{ $mock_code }}</code></p>
            </div>
        @endif
    </form>
</div>
@endsection