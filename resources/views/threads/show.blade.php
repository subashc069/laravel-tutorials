@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
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
                                            Posted By: <a href="#">{{ $thread->creator->name }}</a>
                                        </h5>
                                    </div>

                                    
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="body">{!! $thread->body !!}</div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            @foreach ($thread->replies as $reply)
                @include('threads.reply')
            @endforeach
            @auth
                <div class="col-md-8 col-md-offset-2 pt-2">
                    <form method="POST" action="{{ $thread->path() . '/replies' }}">
                        {{ csrf_field() }}
    
                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                        </div>
    
                        <button type="submit" class="btn btn-primary">Post</button>
                    </form>
                </div>
            @endauth
    
            @guest
                <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.</p>
            @endguest
        </div>

        
    </div>


    
@endsection