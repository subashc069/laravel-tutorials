@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            {{ $profileUser->name }}
            <small>{{ $profileUser->created_at->diffForHumans()}}</small>
        </h1>
        <hr>
        @forelse ($threads as $thread)
            <div class="card mt-2">
                <div class="card-body">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="level">
                                    <h4 class="flex mb-0">
                                        <a href="{{ route('profiles.show', $profileUser) }}">
                                            {{ $profileUser->name }}
                                        </a>
                                        Posted: {{ $thread->title }}
                                    </h4>
                                    <form action="{{ $thread->path()}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-link"
                                        >
                                            Delete Thread
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <hr>
                            <div class="panel-body">
                                <div class="body">{{ $thread->body }}</div>
                            </div>
                        </div>
                </div>
            </div>
        @empty
            <p>There are no relevant results at this time.</p>
        @endforelse
        <div class="mt-2">
            {{ $threads->links() }}
        </div>
    </div>
@endsection