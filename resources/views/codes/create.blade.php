@extends('layouts.app')

@section('content')
    <div class="container mt-5 text-resizable">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="text-resizable">Create codes</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('codes.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="amount">Number of codes to be generated:</label>
                                <input type="number" class="form-control text-resizable" id="amount" name="amount" min="1" max="10" required>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary mt-2 text-resizable">Generate codes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
