@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Threads') }}</div>
                    <div class="card-body">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="level">
                                    <div class="flex">
                                        <h4>
                                            <a href="{{ $thread->path() }}">
                                                {{ $thread->title }}
                                            </a>
                                        </h4>

                                        <h5>
                                            Posted By: <a href="{{ route('profiles.show', ['user' => $thread->creator]) }}">
                                                {{ $thread->creator->name }}
                                            </a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="body">{!! $thread->body !!}</div>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($replies as $reply)
                    @include('threads.reply')
                @endforeach
                <div class="mt-2">
                    {{ $replies->links() }}
                </div>

                @auth
                    <form class="mt-2" method="POST" action="{{ $thread->path() . '/replies' }}">
                        {{ csrf_field() }}
    
                        <div class="form-group">
                            <textarea name="body" 
                                id="body" 
                                class="form-control" 
                                placeholder="Have something to say?" 
                                rows="5"></textarea>
                        </div>
    
                        <button type="submit" class="btn btn-primary">Post</button>
                    </form>
                @endauth
    
                @guest
                    <p class="text-center">
                        Please 
                        <a href="{{ route('login') }}">sign in</a> 
                        to participate in this discussion.
                    </p>
                @endguest

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="body">
                                    This thread was published
                                    {{ $thread->created_at->diffForHumans() }} by 
                                    <a href="http://">
                                        {{ $thread->creator->name }}
                                    </a> and currently has 
                                    {{ $thread->replies_count }} 
                                    {{ Str::plural('comment', $thread->replies_count) }}.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
@endsection
