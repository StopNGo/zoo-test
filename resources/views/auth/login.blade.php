@extends('layouts.app')

@section('page_title', 'Вхід')

@section('content')
<form action="{{ url('/send-sms') }}" method="POST">
    @csrf
    <input type="text" name="phone" placeholder="Введіть свій номер телефону" required>
    <button type="submit">Відправити код</button>
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