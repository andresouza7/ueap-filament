<?php

namespace App\Http\Controllers;

use App\Models\ConsuResolution;
use App\Models\Document;
use App\Models\Portaria;
use App\Models\WebCategory;
use App\Models\WebPost;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $featured = WebPost::where('type', 'news')
            ->where('status', 'published')
            ->where('featured', true)
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        $posts = WebPost::where('type', 'news')
            ->where('status', 'published')
            ->where('featured', false)
            ->orderByDesc('created_at')
            ->take(8)
            ->get();

        $events = WebPost::where('type', 'event')
            ->where('status', 'published')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        return view('novosite.pages.home', compact('featured', 'posts', 'events'));
    }

    public function postList(Request $request)
    {
        $posts = WebPost::where('status', 'published')
            ->when($request->input('search'), function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'ilike', "%{$search}%")
                        ->orWhere('content', 'ilike', "%{$search}%");
                });
            })
            ->when($request->input('type'), fn($q, $type) => $q->where('type', $type))
            ->when($request->query('category'), function ($q, $slug) {
                $q->whereHas('category', fn($q2) => $q2->where('slug', $slug));
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        $categories = WebCategory::has('posts')
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('novosite.pages.post-list', [
            'posts' => $posts,
            'categories' => $categories,
            'searchString' => $request->input('search')
        ]);
    }

    public function postShow($slug)
    {
        $post = WebPost::where('slug', $slug)->where('status', 'published')->firstOrFail();

        WebPost::withoutTimestamps(fn() => $post->increment('hits'));

        $latestPosts = WebPost::where('status', 'published')
            ->where('type', 'news')
            ->orderByDesc('created_at')
            ->orderByDesc('hits')
            ->take(4)
            ->get();

        $relatedPosts = WebPost::latest('id')
            ->where('status', 'published')
            ->whereHas('category', fn($q) => $q->where('name', $post->category->name))
            ->take(4)
            ->get();

        $categories = WebCategory::has('posts')
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('novosite.pages.post-show', compact('post', 'latestPosts', 'relatedPosts', 'categories'));
    }

    public function calendarList(Request $request)
    {
        $items = Document::where('type', 'calendar')
            ->orderByDesc('year')
            ->orderBy('title')
            ->when($request->search, function ($q, $search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('title', 'ilike', "%{$search}%")
                        ->orWhere('description', 'ilike', "%{$search}%");
                });
            })
            ->paginate(25)
            ->withQueryString();

        return view('novosite.pages.calendar-list', compact('items'));
    }

    #################################
    ## CONSU
    #################################
    public function listOrdinance(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'number' => 'nullable|integer',
            'year' => 'nullable|integer',
        ]);

        $items = Portaria::where('origin', 'CONSU')
            ->orderBy('year', 'DESC')
            ->orderBy('number', 'DESC')
            ->when($request->name, fn($q, $n) => $q->where('description', 'ilike', "%{$n}%"))
            ->when($request->number, fn($q, $n) => $q->where('number', $n))
            ->when($request->year, fn($q, $y) => $q->where('year', $y))
            ->paginate(25)
            ->withQueryString();

        return view('novosite.pages.consu-list', [
            'items' => $items,
            'title' => 'CONSU Portarias'
        ]);
    }

    public function listResolution(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'number' => 'nullable|integer',
            'year' => 'nullable|integer',
        ]);

        $items = ConsuResolution::orderBy('year', 'DESC')
            ->orderBy('number', 'DESC')
            ->when($request->name, fn($q, $n) => $q->where('name', 'ilike', "%{$n}%"))
            ->when($request->number, fn($q, $n) => $q->where('number', $n))
            ->when($request->year, fn($q, $y) => $q->where('year', $y))
            ->paginate(25)
            ->withQueryString();

        return view('novosite.pages.consu-list', [
            'items' => $items,
            'title' => 'CONSU Resoluções'
        ]);
    }
}
