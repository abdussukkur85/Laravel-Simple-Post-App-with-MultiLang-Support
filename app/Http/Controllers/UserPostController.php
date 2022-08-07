<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller {
    public function index(User $user) {

        // $posts = Post::with(['user', 'likes'])
        //     ->withTranslation()
        //     ->translatedIn(app()
        //         ->getLocale())
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(2);

        // return view('posts.index', compact('posts'));

        $posts = $user->posts()->with(['user', 'likes'])
            ->withTranslation()
            ->translatedIn(app()
                ->getLocale())->paginate(20);
        return view('user.posts.index', compact('user', 'posts'));
    }
}
