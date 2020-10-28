<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post; 
use Illuminate\Support\Facades\Auth; 

class PostController extends Controller
{
    public function showTopPage()
    {
        $articles = Post::orderBy('created_at', 'asc')->get();
        return view('top', compact('articles'));
    }

    public function index()
    {
        return view('auth.drafts.new');
    }

    public function postArticle(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'tags' => 'required|string',
            'article' => 'required|string',
        ]);

        //空白ごと分割
        $tags = explode(' ', $request->tags);
        $tag1 = $tags[0];
        $tag2 = (isset($tags[1])) ? $tags[1] : null;
        $tag3 = (isset($tags[2])) ? $tags[2] : null;

        $article = Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'tag1' => $tag1,
            'tag2' => $tag2,
            'tag3' => $tag3,
            'body' => $request->article,
        ]);
        return redirect()->route('item', ['id' => $article->id]);
    }
    
    public function showArticle($id)
    {
        $article = Post::where('id', $id)->first();
        return view('auth.item', compact('article'));
    }
}