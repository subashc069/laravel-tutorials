<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $thread->title }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="overflow-hidden shadow-md text-gray-100">
            <!-- card header -->
            <div class="px-6 py-4 bg-gray-800 border-b border-gray-600 font-bold uppercase">
                <a href="#" class="text-blue-400">{{ $thread->creator->name }}</a>
                 posted {{ $thread->title }}
            </div>
    
            <!-- card body -->
            <div class="p-6 bg-gray-800 border-b border-gray-600">
                <!-- content goes here -->
                {{ $thread->body }}
            </div>
        </div>
    </div>
    @foreach ($thread->replies as $reply)
        @include('threads.reply')
    @endforeach
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="overflow-hidden shadow-md text-gray-100">
            <form action="{{ route('replies.store', $thread) }}" method="post">
                @csrf
                <div>
                    <input class="text-gray-700"
                        type="text" 
                        name="body" 
                        placeholder="Write something"
                    >
                </div>  
                <button type="submit" class="text-gray-700">Reply</button>                  
            </form>
        </div>
    </div>
    
</x-app-layout>