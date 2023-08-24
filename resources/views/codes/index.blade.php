@extends('layouts.app')

@section('content')
    <div class="container mt-5 text-resizable">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="text-resizable">List of codes</h4>
                    </div>
                    <div class="card-body">
                        @if($codes->isEmpty())
                            <p>Brak kodów w bazie danych.</p>
                        @else
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                                @foreach($codes as $code)
                                    <li class="mb-2">Id: {{ $code->id }} - Code: {{ $code->code }} - Date: {{ $code->created_at }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
