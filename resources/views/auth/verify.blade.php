@extends('layouts.app')

@section('page_title', 'Верифікація')

@section('content')
<p>Введіть код, надісланий на {{ $phone }}</p>
<form action="{{ url('/login') }}" method="POST">
    @csrf
    <input type="hidden" name="phone" value="{{ $phone }}">
    <input type="text" name="code" placeholder="Введіть код" required>
    <button type="submit">Підтвердити</button>
    </br>
    <small for="code">Правильний код для перевірки: 1234</small>
</form>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection