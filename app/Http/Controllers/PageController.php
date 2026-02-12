<?php

namespace App\Http\Controllers;

use App\Models\ConsuResolution;
use App\Models\Document;
use App\Models\Portaria;
use App\Models\WebCategory;
use App\Models\WebPost;
use App\Models\WebBanner;
use App\Models\WebMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PageController extends Controller
{
    public function home()
    {
        $banners = WebBanner::orderByDesc('created_at')->take(3)->get();

        $featuredCount = $banners->count() > 0 ? 2 : 3;

        $featured = WebPost::where('type', 'news')->where('status', 'published')
            ->where('featured', true)
            ->onlyWithImage()
            ->orderByDesc('created_at')->take($featuredCount)->get();

        $featuredIds = $featured->pluck('id');

        $posts = WebPost::where('type', 'news')
            ->where('status', 'published')
            ->whereNotIn('id', $featuredIds)
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        $events = WebPost::where('type', 'event')->where('status', 'published')->orderByDesc('created_at')->take(4)->get();

        return Inertia::render('Home', compact('featured', 'posts', 'events', 'banners'));
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

        $activeCategory = $categorySlug ? WebCategory::where('slug', $categorySlug)->first() : null;

        return Inertia::render('PostList', compact('posts', 'searchString', 'activeCategory', 'postType'));
    }

    public function postShow($slug)
    {
        $post = WebPost::where('slug', $slug)
            ->where('status', 'published')
            ->with(['web_menu.items' => function ($query) {
                $query->where('status', 'published')->orderBy('position');
            }])
            ->first();

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

            $relatedPosts = WebPost::latest('id')->where('status', 'published')
                ->whereHas('category', function ($query) use ($post) {
                    $query->where('name', $post->category->name);
                })
                ->with(['category'])
                ->take(4)->get();

            return Inertia::render('PostShow', compact('post', 'relatedPosts'));
            // return view('novosite.pages.post-show', compact('post', 'latestPosts', 'relatedPosts', 'categories'));
        } else {
            return abort(404);
        }
    }

    #################################
    ## DOCUMENTS LIST
    #################################

    public function calendarList(Request $request)
    {
        $query = Document::where('type', 'calendar')->orderByDesc('year')->orderBy('title');

        if ($request->search) {
            $query->where('title', 'ilike', "%$request->search%")
                ->orWhere('description', 'ilike', "%$request->search%");
        }

        $items = $query->paginate(15)->withQueryString();

        $items->through(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'date' => $item->created_at->format('d/m/Y'),
                'url' => $item->file_url,
            ];
        });

        return Inertia::render('DocumentList', [
            'title' => 'Calendário Acadêmico',
            'documents' => $items,
        ]);
    }

    public function listOrdinance(Request $request)
    {
        $query = Portaria::where('origin', 'CONSU')->orderBy('year', 'DESC')->orderBy('number', 'DESC');

        if ($request->search || $request->name) { // Support both new unified search and legacy param
            $term = $request->search ?? $request->name;
            $query->where('description', 'ilike', "%$term%");
        }

        if ($request->number) {
            $request->validate(['number' => 'integer']);
            $query->where('number',  $request->number);
        }

        if ($request->year) {
            $request->validate(['year' => 'integer']);
            $query->where('year',  $request->year);
        }

        $items = $query->paginate(15)->withQueryString();
        $title = 'CONSU Portarias';

        $items->through(function ($item) {
            return [
                'id' => $item->id,
                'title' => "Portaria Nº {$item->number}/{$item->year}" . ($item->description ? " - " . Str::limit($item->description, 100) : ""),
                'category' => 'PORTARIA',
                'date' => (string)$item->number . '/' . (string)$item->year,
                'url' => $item->file_url,
            ];
        });

        return Inertia::render('DocumentList', [
            'title' => $title,
            'documents' => $items
        ]);
    }

    public function listResolution(Request $request)
    {
        $query = ConsuResolution::orderBy('year', 'DESC')->orderBy('number', 'DESC');

        if ($request->search || $request->name) { // Support both new unified search and legacy param
            $term = $request->search ?? $request->name;
            $query->where('name', 'ilike', "%$term%");
        }

        if ($request->number) {
            $request->validate(['number' => 'integer']);
            $query->where('number',  $request->number);
        }

        if ($request->year) {
            $request->validate(['year' => 'integer']);
            $query->where('year',  $request->year);
        }

        $items = $query->paginate(15)->withQueryString();
        $title = 'CONSU Resoluções';

        $items->through(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->name ?? "Resolução Nº {$item->number}/{$item->year}",
                'category' => 'RESOLUÇÃO',
                'date' => (string)$item->number . '/' . (string)$item->year,
                'url' => $item->file_url,
            ];
        });

        return Inertia::render('DocumentList', [
            'title' => $title,
            'documents' => $items
        ]);
    }

    public function courseList($slug)
    {
        if (!in_array($slug, ['graduacao', 'pos', 'ext'])) {
            return abort(404);
        }

        $menu = WebMenu::where('slug', 'ilike', $slug)
            ->where('status', 'published')
            ->with(['items' => function ($query) {
                $query->where('status', 'published')->orderBy('name');
            }])
            ->first();

        $cursos = $menu ? $menu->items : [];

        return Inertia::render('CourseList', [
            'slug' => $slug,
            'cursos' => $cursos,
            'menu' => $menu,
        ]);
    }
}
