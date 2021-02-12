<div class="card mt-2">
    <div class="card-header">{{ __('Reply') }}</div>
    <div class="card-body">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="level">
                    <div class="flex">
                        <h5>
                            <a href="#">
                                {{ $reply->owner->name }}
                            </a> said {{ $reply->created_at->diffForHumans() }}...
                        </h5>
                    </div>
                    <div>
                        <form action="/replies/{{$reply->id}}/favorites" method="POST">
                            @csrf
                            <button type="submit" 
                                class="btn btn-primary"
                                {{ $reply->isFavorited() ? 'disabled' : ''}}
                            >
                                {{ $reply->favorites()->count() }} 
                                {{ Str::plural('favorite', $reply->favorites()->count()) }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <h5>
                    {{ $reply->body }}
                </h5>
            </div>
        </div>
    </div>
</div>
