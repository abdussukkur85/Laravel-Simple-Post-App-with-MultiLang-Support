<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\PostTranslation;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use Astrotomic\Translatable\Validation\RuleFactory;

class PostController extends Controller {
    public function index() {
        $posts = Post::translatedIn(app()->getLocale())->latest()->paginate(2);
        return view('posts.index', compact('posts'));
    }

    public function create(StorePostRequest $request) {


        Post::create($request->validate());
        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->save();
        foreach (config('translatable.locales') as $locale) {
            $post_translation = new PostTranslation();
            $post_translation->post_id = $post->id;
            $post_translation->title = $request->$locale{
                'title'};
            $post_translation->locale = $locale;
            $post_translation->description = $request->$locale{
                'description'};
            $post_translation->save();
        }

        return redirect()->back()->withSuccess('Post Created Successfully!');
    }

    public function show($id) {

        return Post::translatedIn(app()->getLocale())->findOrFail($id);
        return view('posts.show', compact('post'));
    }
}
