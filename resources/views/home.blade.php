@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (Auth::check())
                        <form method="post" action="{{ route('github.releases') }}">
                            @csrf
                            <label for="repo_url">Enter GitHub repository URL:</label>
                            <input type="text" name="repo_url" id="repo_url">
                            <input type="submit" value="Get Releases">
                        </form>
                     
                        @if (isset($releases))
                            <h2>Releases:</h2>
                            <ul>
                                @foreach ($releases as $release)
                                    <li><a href="{{ $release->zipball_url }}">{{ $release->name }}</a></li>
                                @endforeach
                            </ul>
                        @endif

                        @if (Session::has('message'))
                            <div>{{ Session::get('message') }}</div>
                        @endif                
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
