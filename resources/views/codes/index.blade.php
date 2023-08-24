@extends('layouts.app')

@section('content')
    <h2>List of codes</h2>
    @if($codes->isEmpty())
        <p>Brak kodów w bazie danych.</p>
    @else
        <ul>
            @foreach($codes as $code)
                <li>Id: {{ $code->id }} - Code: {{ $code->code }} - Date: {{ $code->created_at }}</li>
            @endforeach
        </ul>
    @endif
@endsection
