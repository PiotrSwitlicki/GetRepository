@extends('layouts.app')

@section('content')                    
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
@endsection