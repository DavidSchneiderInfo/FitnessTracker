@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Welcome') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <ul>
                            <li>
                                <a href="https://laravel.com/docs">Laravel Docs</a>
                            </li>
                            <li>
                                <a href="https://laracasts.com">Laracasts</a>
                            </li>
                            <li>
                                <a href="https://laravel-news.com">Laravel News</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
