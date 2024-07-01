<!-- resources/views/blogs/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <x-label for="title" value="Title" />
                        <x-input id="title" class="block mt-1 w-full" type="text" name="title" required autofocus />
                    </div>

                    <div class="mb-4">
                        <x-label for="content" value="Content" />
                        <textarea id="content" class="block mt-1 w-full" name="content" required></textarea>
                    </div>

                    <div class="mb-4">
                        <x-label for="image" value="Image" />
                        <x-input id="image" class="block mt-1 w-full" type="file" name="image" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ms-4">
                            {{ __('Create Blog') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
