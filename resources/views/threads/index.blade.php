@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Threads') }}</div>
                <div class="card-body">
                    @forelse ($threads as $thread)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="level">
                                    <h4 class="flex mb-0">
                                        <a href="{{ $thread->path() }}">
                                            {{ $thread->title }}
                                        </a>
                                    </h4>
                                    <a href="{{ $thread->path()}}">
                                        <strong>{{ $thread->replies_count }} {{ Str::plural('comment') }}</strong>
                                    </a>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="body">{{ $thread->body }}</div>
                            </div>
                        </div>
                        <hr>
                    @empty
                        <p>There are no relevant results at this time.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
