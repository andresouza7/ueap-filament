<?php

namespace App\Http\Controllers;

use App\Models\WebPage;
use App\Models\WebPost;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $featured = WebPost::whereRelation('category.section', 'slug', 'news')->where('status', 'published')
            ->where('featured', true)->orderByDesc('created_at')->take(3)->get();
        $posts = WebPost::whereRelation('category.section', 'slug', 'news')->where('status', 'published')->orderByDesc('created_at')->take(4)->get();
        $events = WebPost::whereRelation('category.section', 'slug', 'events')->where('status', 'published')->orderByDesc('created_at')->take(3)->get();
        return view('novosite.pages.home', compact('posts', 'events', 'featured'));
    }

    public function pageShow($slug)
    {

        $page = WebPage::where('slug', $slug)->where('status', 'published')->first();

        if ($page) {
            $page->hits = $page->hits + 1;
            $page->save();

            return view('novosite.pages.page-show', compact('page'));
        } else {
            return redirect()->route('novosite.home');
        }
    }

    public function postList(Request $request)
    {
        $searchString = $request->input('qry');

        $query = WebPost::where('status', 'published')->whereRelation('category.section', 'slug', 'news');

        if ($searchString) {
            $query->search($searchString);
        }

        $posts = $query->orderByDesc('id')->simplePaginate(10)->withQueryString();

        return view('novosite.pages.post-list', compact('posts', 'searchString'));
    }

    public function postShow($slug)
    {
        $post = WebPost::where('slug', $slug)->where('status', 'published')->first();
        $posts = WebPost::latest('id')->where('status', 'published')->take(4)->get();

        if ($post) {
            $post->hits = $post->hits + 1;
            $post->save();
            return view('novosite.pages.post-show', compact('post', 'posts'));
        } else {
            return redirect()->route('novosite.home');
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
