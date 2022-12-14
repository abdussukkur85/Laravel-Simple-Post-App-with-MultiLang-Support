<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller {
    public function index(User $user) {

        $posts = $user->posts()->with(['user', 'likes'])
            ->withTranslation()
            ->translatedIn(app()
                ->getLocale())->paginate(20);
        return view('user.posts.index', compact('user', 'posts'));
    }
}
