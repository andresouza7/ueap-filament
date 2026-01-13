<?php

namespace App\Http\Controllers;

use App\Models\WebCategory;
use App\Models\WebPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function home()
    {
        $featured = WebPost::where('type', 'news')->where('status', 'published')
            ->where('featured', true)->orderByDesc('created_at')->take(3)->get();
        $posts = WebPost::where('type', 'news')->where('status', 'published')
            ->where('featured', false)->orderByDesc('created_at')->take(8)->get();
        $events = WebPost::where('type', 'event')->where('status', 'published')->orderByDesc('created_at')->take(4)->get();

        return view('novosite.pages.home', compact('featured', 'posts', 'events'));
    }

    public function postList(Request $request)
    {
        $searchString = $request->input('search');
        $postType = $request->input('type');
        $categorySlug = $request->query('category');

        $query = WebPost::where('status', 'published');

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

        // if ($searchString) {
        //     $query->search($searchString);
        // }

        $posts = $query->orderByDesc('created_at')->paginate(10)->withQueryString();
        $categories = WebCategory::has('posts')
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('novosite.pages.post-list', compact('posts', 'categories', 'searchString'));
    }

    public function postShow($slug)
    {
        $post = WebPost::where('slug', $slug)->where('status', 'published')->first();
        $latestPosts = WebPost::where('status', 'published')->where('type', 'news')
            ->orderBy('created_at', 'desc')->orderBy('hits', 'desc')->take(4)->get();
        $relatedPosts = WebPost::latest('id')->where('status', 'published')
            ->whereHas('category', function ($query) use ($post) {
                $query->where('name', $post->category->name);
            })
            ->take(4)->get();
        $frequentPages = WebPost::where('status', 'published')->where('type', 'page')->orderBy('created_at', 'desc')->take(5)->get();

        $categories = WebCategory::has('posts')
            ->inRandomOrder()
            ->take(6)
            ->get();


        if ($post) {
            WebPost::withoutTimestamps(function () use ($post) {
                $post->increment('hits', 1);
            });

            return view('novosite.pages.post-show', compact('post', 'latestPosts', 'relatedPosts', 'categories', 'frequentPages'));
        } else {
            return redirect()->route('site.home');
        }
    }

    // public function documentList($type)
    // {
    //     $check = new DocumentController();

    //     if($check->checkType($type)){
    //         $documents = Document::where('type', $type)->orderByDesc('year')->orderByDesc('title')->paginate(25)->withQueryString();
    //         return view('site.pages.document-list', compact('documents'));
    //     }
    //     return redirect()->route('site.home');
    // }


    // public function normativeInstructionList($type=false)
    // {
    //     $instructions = NormativeInstruction::orderBy('year', 'DESC')
    //     ->orderBy('number', 'DESC')
    //     ->paginate(25)
    //     ->withQueryString();
    //     return view('site.pages.document-normative-instruction-list', compact('instructions'));


    // }
}
