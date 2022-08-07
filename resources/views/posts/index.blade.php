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
    </style>
@endpush
@section('title', 'Post Create')
@section('content')
    <div class="container">
        <div class="row">
            @if (Session::get('success'))
                <div class="col-md-8 offset-md-2 mt-3">
                    <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                        {{ session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

            @if (Session::get('errors'))
                <div class="col-md-8 offset-md-2 mt-3">
                    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                        {{ Session::get('errors')->first() }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

            <div class="col-md-8 offset-md-2 bg-light mt-3 br-5 rounded p-4">
                @auth
                    <form action="{{ route('posts') }}" method="POST">
                        @csrf

                        @foreach (config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label for="postTitle{{ $locale }}">{{ __('Post Title') }}
                                    ({{ __(strtoupper($locale)) }})
                                </label>
                                <input class="form-control @error($locale . '.title') border-danger @enderror"
                                    name="{{ $locale }}[title]" id="postTitle_{{ $locale }}"
                                    value="{{ old($locale . '.title') }}">
                                @error($locale . '.title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description{{ $locale }}">{{ __('Post Description') }}
                                    ({{ __(strtoupper($locale)) }})
                                </label>
                                <textarea class="form-control @error($locale . '.description') border-danger @enderror"
                                    name="{{ $locale }}[description]" id="description{{ $locale }}" rows="3"
                                    placeholder="{{ __('Write Something!') }}" value="{{ old($locale . '.description') }}"></textarea>

                                @error($locale . '.description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">{{ __('Save Post') }}</button>
                    </form>
                @endauth

                @if ($posts->count())
                    @foreach ($posts as $post)
                        <div class="post mt-4">
                            <p class="mb-0"><b><i><u>{{ __('Written By') }}:</u></i></b> <a class="user-profile"
                                    href=""><b>{{ $post->user->name }}</b></a>
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
                            @auth
                                @if ($post->ownedBy(auth()->user()))
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="delete" type="submit">{{ __('Delete') }}</button>
                                    </form>
                                @endif
                            @endauth
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
                    No Post Found!
                @endif

                <div class="d-flex justify-content-end">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
