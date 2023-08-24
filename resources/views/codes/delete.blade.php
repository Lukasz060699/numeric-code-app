@extends('layouts.app')

@section('content')
    <h2>Delete codes</h2>

    <form action="{{ route('codes.destroy') }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="form-group">
            <label for="codesToDelete">Enter the codes to be deleted (separated by commas or new lines):</label>
            <textarea class="form-control" id="codesToDelete" name="codesToDelete" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Delete codes</button>
    </form>
@endsection
