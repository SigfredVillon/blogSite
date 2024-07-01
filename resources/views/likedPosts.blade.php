<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Homepage') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-white" style="background-image: url('{{ asset('storage/bg.jpg') }}');">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Filters -->
                <div class="mb-4">
                    <a href="{{ route('dashboard.sort', 'most-liked') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Most Liked</a>
                    <a href="{{ route('dashboard.sort', 'most-commented') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Most Commented</a>
                    <a href="{{ route('dashboard.sort', 'chronological') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Chronological</a>
                </div>

                @if(isset($message))
                    <p>{{ $message }}</p>
                @else
                    @foreach ($blogs as $blog)
                        <div class="mb-4 p-4 border border-blue-200 rounded-lg bg-blue-50">
                            <h3 class="text-lg font-bold">{{ $blog->title }}</h3>
                            @if($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" style="max-width: 200px;" class="my-4">
                            @endif
                            @php
                            $sentences = explode('.', $blog->content);
                            $first_sentence = $sentences[0];
                             @endphp
                             <p>{{ $first_sentence }}</p>

                            <div class="flex justify-between items-center mt-2">
                                <div class="flex space-x-4">
                                 
                                    <a href="{{ route('show', $blog) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Check it out</a>
                                </div>
                                <span class="text-gray-600">{{ $blog->likes->count() }} likes</span>
                                <span class="text-gray-600">{{ $blog->comments->count() }} comments</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
