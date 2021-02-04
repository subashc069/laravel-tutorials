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
                {{ $thread->title }}
            </div>
    
            <!-- card body -->
            <div class="p-6 bg-gray-800 border-b border-gray-600">
                <!-- content goes here -->
                {{ $thread->body }}
            </div>
        </div>
    </div>
    @foreach ($thread->replies as $reply)
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 py-6">
            <div class="overflow-hidden shadow-md">
                <!-- card header -->
                <div class="px-6 py-4 bg-white border-b border-gray-200 font-bold uppercase">
                    <a href="#" class="text-blue-400">
                        {{ $reply->owner->name }}
                    </a>
                    said {{ $reply->created_at->diffForHumans() }}...
                </div>
        
                <!-- card body -->
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- content goes here -->
                    {{ $reply->body }}
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>