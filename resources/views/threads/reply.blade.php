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