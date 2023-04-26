<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('article.index', [
            'categories' => Category::all(),
            'articles' => Article::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Display a listing of the resource created by the user.
     */
    public function user(): View
    {
        return view('article.user', [
            'articles' => Article::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get(),
        ]);
    }

    /**
     * Display a listing of the resource with selected category.
     */
    public function category($slug)
    {
        return view('article.index', [
            'categories' => Category::all(),
            'articles' => Category::where('slug', $slug)->first()->article()->orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('article.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'hook' => ['required'],
            'content' => ['required'],
            'cover' => ['nullable', 'mimes:png,jpg,jpeg,webp']
        ]);

        $article = new Article;

        $article->user_id = Auth::user()->id;

        $article->fill([
            'title' => $request->title,
            'hook' => $request->hook,
            'content' => $request->content,
            'submitted' => 1,
        ]);

        $article->slug = Str::of($request->title)->slug('-');

        if ($request->hasFile('cover')) {
            $article->cover = $request->file('cover')->store('covers', 'public');
        };

        $article->save();

        if ($request->has('category')) {
            foreach ($request->category as $category) {
                $article->category()->attach($category);
            };
        };

        return redirect(route('article.user'));
    }

    /**
     * Display the specified resource.
     */
    public function show($slug): View
    {
        $article = Article::where('slug', $slug)->first();
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $this->authorize('update', $id);

        $article = Article::findOrFail($id);
        $categories = Category::all();
        return view('article.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->authorize('update', $id);

        $article = Article::find($id);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'hook' => ['required'],
            'content' => ['required'],
            'cover' => ['nullable', 'mimes:png,jpg,jpeg,webp']
        ]);

        if ($request->hasFile('cover')) {
            Storage::disk('public')->delete($article->cover); //Delete old file
            $cover = $request->file('cover')->store('covers', 'public');
            $article->update([
                'cover' => $cover
            ]);
        };

        $article->slug = Str::of($request->title)->slug('-');

        $article->update([
            'title' => $request->title,
            'hook' => $request->hook,
            'content' => $request->content,
        ]);

        $article->category()->detach();

        if ($request->has('category')) {
            foreach ($request->category as $category) {
                $article->category()->attach($category);
            };
        };

        return redirect(route('article.user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
