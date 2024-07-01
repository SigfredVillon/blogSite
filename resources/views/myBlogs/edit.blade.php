<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Blog Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ route('blogs.update', $blog->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-label for="title" value="{{ __('Title') }}" />
                        <x-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $blog->title }}" required />
                    </div>
                    <div class="mt-4">
                        <x-label for="content" value="{{ __('Content') }}" />
                        <textarea id="content" class="block mt-1 w-full" name="content" required>{{ $blog->content }}</textarea>
                    </div>
                    <div class="mt-4">
                        <x-label for="image" value="{{ __('Image') }}" />
                        <x-input id="image" class="block mt-1 w-full" type="file" name="image" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-button>
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
