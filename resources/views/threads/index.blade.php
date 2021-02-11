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
                    @empty
                        <p>There are no relevant results at this time.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection