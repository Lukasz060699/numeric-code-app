@extends('layouts.app')

@section('content')
    <div class="container mt-5 text-resizable">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card">
                    @if(session('success'))
                        <div class="alert alert-success text-resizable">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-header text-center">
                        <h4 class="text-resizable">List of codes</h4>
                    </div>
                    <div class="card-body">
                        @if($codes->isEmpty())
                            <p>Brak kodów w bazie danych.</p>
                        @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Code</th>
                                <th scope="col">Data</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($codes as $code)
                                <tr>
                                <td>{{ $code->id }}</td>
                                <td>{{ $code->user->email ? $code->user->name : 'N/A' }}</td>
                                <td>{{ $code->code }}</td>
                                <td>{{ $code->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            </table>
                        @endif
                    </div>
                </div>
                {{ $codes->links() }}
            </div>
        </div>
    </div>
@endsection
