<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog Details') }}

    </x-slot>

    <div class="py-12 bg-white" style="background-image: url('{{ asset('storage/bg.jpg') }}'); background-size: cover;">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex items-start mb-6">
                    @if($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" style="max-width: 200px;" class="mr-8 rounded-lg">
                    @endif
                    <div class="flex flex-col w-full">
                        
                        <h3 class="text-lg font-bold mb-2">{{ $blog->title }}</h3>
                        <p class="mb-4">{{ $blog->content }}</p>

                        <!-- Like Functionality -->
                        <div class="flex justify-between items-center">
                            <div>
                                <form action="{{ route('blogs.like', $blog) }}" method="POST">
                                    @csrf
                                    @if($blog->likes->contains('user_id', auth()->id()))
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Unlike</button>
                                    @else
                                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Like</button>
                                    @endif
                                </form>
                            </div>
                            <div>
                                <span class="text-gray-600">{{ $blog->likes->count() }} likes</span>
                            </h2>
                            <p class="text-gray-500 text-sm mt-2">
                                Posted {{ $blog->created_at->diffForHumans() }}
                            </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comment Functionality -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h4 class="font-bold mb-2">Comments</h4>
                    <form action="{{ route('blogs.comment', $blog) }}" method="POST" class="mb-4">
                        @csrf
                        <textarea name="content" required class="w-full p-2 border border-gray-300 rounded mb-2" rows="3" placeholder="Add a comment..."></textarea>
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Comment</button>
                    </form>
                    
                    <!-- Display Comments -->
                    <div>
                        @foreach($blog->comments->sortByDesc('created_at') as $comment)
                            <div class="mb-2 p-4 border border-gray-300 rounded">
                                <strong>{{ $comment->user->name }}</strong> 
                                <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                                <p>{{ $comment->content }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
