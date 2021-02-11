@foreach ($thread->replies as $reply)
<div class="col-md-8 col-md-offset-2 pt-2">
    <div class="card">
        <div class="card-header">{{ __('Reply') }}</div>

        <div class="card-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="level">
                        <div class="flex">
                            <h4>
                                <a href="#">
                                    {{ $reply->owner->name }}
                                </a> said {{ $reply->created_at->diffForHumans() }}...
                            </h4>

                            <h5>
                                {{ $reply->body }}

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
@endforeach