@extends('layouts.app')

@section('content')
    <div class="container mt-5 text-resizable">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="text-resizable">Delete codes</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('codes.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="form-group">
                                <label for="codesToDelete">Enter the codes to be deleted (separated by commas or new lines):</label>
                                <textarea class="form-control text-resizable" id="codesToDelete" name="codesToDelete" rows="5" required></textarea>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary mt-2 text-resizable">Delete codes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
