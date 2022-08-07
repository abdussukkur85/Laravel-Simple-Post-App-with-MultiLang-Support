<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PostLikeController extends Controller {
    public function like(Post $post, Request $request) {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        if ($post->likedBy($request->user())) {
            return redirect()->back()->withErrors("You already liked the post");
        }

        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        if (!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()) {
            Mail::to($post->user)->send(new PostLiked(Auth::user(), $post));
        }

        return back();
    }

    public function destroy(Post $post, Request $request) {
        $request->user()->likes()->where('post_id', $post->id)->delete();
        return back();
    }
}
