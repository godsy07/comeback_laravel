@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg  mb-10">
            {{-- @if (session('status'))
                <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif --}}
            @auth
                <form action="{{ route('posts') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="body" class="sr-only">Body</label>
                        <textarea type="text" name="body" id='body' cols="30" rows="4" placeholder="Post Something " class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" value="{{ old('body') }}"></textarea>
                        @error('body')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium">Post</button>
                    </div>
                </form>
            @endauth

            @if ($posts->count())
                @foreach ($posts as $post)
                    <x-post :post="$post" />
                @endforeach

                {{-- Pagination --}}
                {{ $posts->links() }}
            @else
                <p>There are no posts.</p>
            @endif
        </div>
    </div>
@endsection
