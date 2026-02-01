<?php

namespace App\Http\Controllers;

use App\Models\ConsuResolution;
use App\Models\Document;
use App\Models\Portaria;
use App\Models\WebCategory;
use App\Models\WebPost;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function home()
    {
        $featured = WebPost::where('type', 'news')->where('status', 'published')
            ->where('featured', true)->orderByDesc('created_at')->take(3)->get();
        $posts = WebPost::where('type', 'news')->where('status', 'published')
            ->where('featured', false)->orderByDesc('created_at')->take(3)->get();
        $events = WebPost::where('type', 'event')->where('status', 'published')->orderByDesc('created_at')->take(4)->get();

        return Inertia::render('Home', compact('featured', 'posts', 'events'));
        // return view('novosite.pages.home', compact('featured', 'posts', 'events'));
    }

    public function postList(Request $request)
    {
        $searchString = $request->input('search');
        $postType = $request->input('type');
        $categorySlug = $request->query('category');

        $query = WebPost::where('status', 'published')->with('category');

        if ($searchString) {
            $query->where('title', 'ilike', "%$searchString%")
                ->orWhere('content', 'ilike', "%$searchString%");
        }

        if ($postType) {
            $query->where('type', $postType);
        }

        if ($categorySlug) {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        $posts = $query->orderByDesc('created_at')->paginate(10)->withQueryString();

        $categories = WebCategory::has('posts')
            ->inRandomOrder()
            ->take(6)
            ->get();

        $latestPosts = WebPost::where('status', 'published')->where('type', 'news')
            ->orderBy('created_at', 'desc')->orderBy('hits', 'desc')->take(4)->get();

        return Inertia::render('PostList', compact('posts', 'categories', 'searchString', 'latestPosts'));
    }

    public function postShow($slug)
    {
        $post = WebPost::where('slug', $slug)->where('status', 'published')->first();

        if ($post) {
            // Apply clean_text to content blocks before sending to frontend
            if (is_array($post->content)) {
                $post->content = array_map(function ($block) {
                    if (isset($block['type']) && $block['type'] === 'text' && isset($block['data']['body'])) {
                        $block['data']['body'] = clean_text($block['data']['body']);
                    }
                    return $block;
                }, $post->content);
            }

            WebPost::withoutTimestamps(function () use ($post) {
                $post->increment('hits', 1);
            });

            $latestPosts = WebPost::where('status', 'published')->where('type', 'news')
                ->orderBy('created_at', 'desc')->orderBy('hits', 'desc')->take(4)->get();

            $relatedPosts = WebPost::latest('id')->where('status', 'published')
                ->whereHas('category', function ($query) use ($post) {
                    $query->where('name', $post->category->name);
                })
                ->with(['category'])
                ->take(4)->get();

            $categories = WebCategory::has('posts')
                ->inRandomOrder()
                ->take(6)
                ->get();

            return Inertia::render('PostShow', compact('post', 'latestPosts', 'relatedPosts', 'categories'));
            // return view('novosite.pages.post-show', compact('post', 'latestPosts', 'relatedPosts', 'categories'));
        } else {
            return abort(404);
        }
    }

    public function calendarList(Request $request)
    {
        $query = Document::where('type', 'calendar')->orderByDesc('year')->orderBy('title');

        if ($request->search) {
            $query->where('title', 'ilike', "%$request->search%")
                ->orWhere('description', 'ilike', "%$request->search%");
        }

        $items = $query->paginate(25)->withQueryString();

        return view('novosite.pages.calendar-list', compact('items'));
    }

    #################################
    ## CONSU
    #################################
    public function listOrdinance(Request $request)
    {
        $query = Portaria::where('origin', 'CONSU')->orderBy('year', 'DESC')->orderBy('number', 'DESC');

        if ($request->name) {
            $request->validate(['name' => 'string|max:255']);
            $query
                ->where('description', 'ilike', "%$request->name%");
        }

        if ($request->number) {
            $request->validate(['number' => 'integer']);
            $query->where('number',  $request->number);
        }

        if ($request->year) {
            $request->validate(['year' => 'integer']);
            $query->where('year',  $request->year);
        }

        $items = $query->paginate(25)->withQueryString();
        $title = 'CONSU Portarias';

        return view('novosite.pages.consu-list', compact('items', 'title'));
    }

    public function listResolution(Request $request)
    {
        $query = ConsuResolution::orderBy('year', 'DESC')->orderBy('number', 'DESC');

        if ($request->name) {
            $request->validate(['name' => 'string|max:255']);
            $query->where('name', 'ilike', "%$request->name%");
        }

        if ($request->number) {
            $request->validate(['number' => 'integer']);
            $query->where('number',  $request->number);
        }

        if ($request->year) {
            $request->validate(['year' => 'integer']);
            $query->where('year',  $request->year);
        }

        $items = $query->paginate(25)->withQueryString();
        $title = 'CONSU Resoluções';

        return view('novosite.pages.consu-list', compact('items', 'title'));
    }
}
