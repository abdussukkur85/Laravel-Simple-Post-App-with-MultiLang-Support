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
            <div class="col-md-8 offset-md-2 bg-light mt-3 br-5 rounded p-3">
                <div class="post mt-3">
                    <p class="mb-0"><b><i><u>{{ __('Written By') }}:</u></i></b>
                        <a class="user-profile" href="{{ route('user.posts', $post->user) }}"><b class="username">
                                {{ $post->user->name }}</b></a>
                        <span><i>{{ $post->created_at->diffForHumans() }}</i></span>
                    </p>
                    <p class="mb-0"><b><i><u>{{ __('Title') }}:</u></i></b> {{ $post->title }}</p>
                    <b><i><u>{{ __('Description') }}:</u></i></b>
                    {{ $post->description }}
                    @if ($post->ownedBy(Auth::user()))
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


            </div>
        </div>
    </div>
@endsection
