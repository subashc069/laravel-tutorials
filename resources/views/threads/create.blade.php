@extends('layouts.app')    

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create thread') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('threads.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="title" 
                                    class="col-md-4 col-form-label text-md-right">{{ __('Give it a title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" 
                                        type="text" 
                                        class="form-control @error('title') is-invalid @enderror" 
                                        name="title" value="{{ old('title') }}" 
                                        autofocus
                                    >

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="channel_id">Example select</label>
                                <div class="col-md-6">
                                    <select class="form-control @error('channel_id') is-invalid @enderror" name="channel_id">
                                        <option>Select One</option>
                                        @foreach ($channels as $channel)
                                            <option value="{{ $channel->id }}" {{ $channel->id == old('channel_id') ? 'selected' : '' }}>{{ $channel->slug }}</option>
                                        @endforeach
                                    </select>
                                    @error('channel_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="body" 
                                    class="col-md-4 col-form-label text-md-right"
                                >
                                    {{ __('Your thread details') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="body" 
                                        type="text" 
                                        class="form-control @error('body') is-invalid @enderror" 
                                        name="body" 
                                    >

                                    @error('body')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
