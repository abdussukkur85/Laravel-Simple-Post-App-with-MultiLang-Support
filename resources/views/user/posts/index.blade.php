@extends('layout.app')
@push('css')
    <style>
        button.like_btn,
        button.delete {
            background: none;
            border: none;
            font-weight: 500;
            color: #0062cc;
            padding-left: 0;
            padding-right: 10px;
            font-size: 15px;
        }

        a.user-profile {
            text-decoration: none;
            color: #000;
        }

        .post>a {
            text-decoration: none;
            color: #000;
        }

        .username {
            text-transform: capitalize;
        }
    </style>
@endpush
@section('title', 'Dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 mt-3">
                <h2 class="username">{{ $user->name }}</h2>
                <p><b>{{ __('Posted') }}: </b> {{ __($posts->count() . ' ' . \Str::plural('Post', $posts->count())) }}

                    {{ __('and received') }}
                    <b>{{ __($user->receivedLikes->count() . ' ' . \Str::plural('Like', $user->receivedLikes->count())) }}</b>
                </p>
            </div>
            <div class="col-md-8 offset-md-2 bg-light mt-3 br-5 rounded p-3">
                @if ($posts->count())
                    @foreach ($posts as $post)
                        <div class="post mt-3">
                            <p class="mb-0"><a class="user-profile" href="{{ route('user.posts', $post->user) }}"><b
                                        class="username">{{ $post->user->name }}</b></a>
                                <span><i>{{ $post->created_at->diffForHumans() }}</i></span>
                            </p>
                            <a href="{{ route('posts.show', $post->id) }}">
                                <p class="mb-0"><b><i><u>{{ __('Title') }}:</u></i></b> {{ $post->title }}</p>
                            </a>
                            <b><i><u>{{ __('Description') }}:</u></i></b>
                            {{ Str::limit($post->description, 100, '') }}
                            @if (Str::length($post->description) > 100)
                                <a href="{{ route('posts.show', [$post->id]) }}" class="text-primary">Read
                                    More...</a>
                            @endif
                            @if (Auth::user() && $post->ownedBy(Auth::user()))
                                <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="delete" type="submit"
                                        onclick="return confirm('Are you sure you want to Delete?')">{{ __('Delete') }}</button>
                                </form>
                            @endif
                            <div class="d-flex">
                                @auth
                                    @if (!$post->likedBy(auth()->user()))
                                        <form action="{{ route('posts.likes', $post->id) }}" method="post">
                                            @csrf
                                            <button class="like_btn" type="submit"> <i class="fas fa-thumbs-up"></i></button>
                                        </form>
                                    @else
                                        <form action="{{ route('posts.likes', $post) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="like_btn" type="submit"><i class="fas fa-thumbs-down"></i></button>
                                        </form>
                                    @endif
                                @endauth

                                <p>{{ __($post->likes->count()) }} {{ __(\Str::plural('Like', $post->likes->count())) }}
                                </p>
                            </div>

                        </div>
                    @endforeach
                @else
                    {{ $user->name }} does not have any post!
                @endif

                <div class="d-flex justify-content-end">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
