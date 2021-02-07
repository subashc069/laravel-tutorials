<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @foreach ($threads as $thread)
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 py-6">
            <div class="overflow-hidden shadow-md text-gray-100">
                <!-- card header -->
                <div class="px-6 py-4 bg-gray-800 border-b border-gray-600 font-bold uppercase">
                    <a href="{{ $thread->path() }}" class="text-blue-400">{{ $thread->title }}</a>
                </div>
        
                <!-- card body -->
                <div class="p-6 bg-gray-800 border-b border-gray-600">
                    <!-- content goes here -->
                    {{ $thread->body }}
                </div>
            </div>
        </div>
    @endforeach
                
</x-app-layout>