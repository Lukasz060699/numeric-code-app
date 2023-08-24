@extends('layouts.app')

@section('content')
    <h2>Create codes</h2>

    <form action="{{ route('codes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="amount">Number of codes to be generated:</label>
            <input type="number" class="form-control" id="amount" name="amount" min="1" max="10" required>
        </div>
        <button type="submit" class="btn btn-primary">Generate codes</button>
    </form>
@endsection
