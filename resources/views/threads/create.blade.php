<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ $thread->title }} --}}
        </h2>
    </x-slot>
    
    <div class="pt-6">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Create Thread</h3>
                <p class="mt-1 text-sm text-gray-600">
                This information will be displayed publicly so be careful what you share.
                </p>
            </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{ route('threads.store') }}" method="POST">
                @csrf
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-6 sm:col-span-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Thread Title</label>
                            <input type="text" 
                                name="title" 
                                id="title"
                                value="{{ old('title') }}" 
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            >
                        </div>
                    </div>

                    <div>
                    <label for="body" class="block text-sm font-medium text-gray-700">
                        Your thread
                    </label>
                    <div class="mt-1">
                        <textarea id="body" 
                            name="body" 
                            rows="3" 
                            value="{{ old('body') }}" 
                            class="@error('body') is-invalid @enderror shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" 
                            placeholder="Your thread here"
                        ></textarea>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                        Enter your thread
                    </p>
                    </div>

                    <div>
                    
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save
                    </button>
                </div>
                @error('title', 'body', 'channel_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
            </form>
            </div>
        </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

</x-app-layout>