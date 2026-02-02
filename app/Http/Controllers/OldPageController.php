<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Controllers\DocumentController;
use App\Models\Document;
use App\Models\NormativeInstruction;
use App\Models\WebPage;
use App\Models\WebPost;
use Illuminate\Http\Request;

class OldPageController extends Controller
{


    public function home()
    {
        $posts = WebPost::whereRelation('category.section', 'slug', 'news')->where('status', 'published')->orderByDesc('created_at')->paginate(10)->withQueryString();
        $events = WebPost::whereRelation('category.section', 'slug', 'events')->where('status', 'published')->orderByDesc('created_at')->paginate(10)->withQueryString();
        return view('site.pages.home', compact('posts', 'events'));
    }

    public function pageShow($slug)
    {

        $page = WebPage::where('slug', $slug)->where('status', 'published')->first();
         $latestPosts = WebPost::latest('id')->where('status', 'published')->take(4)->get();

        if ($page) {
            // Updating with logging disabled
            WebPage::withoutTimestamps(function () use ($page) {
                $page->disableLogging();
                $page->increment('hits', 1);
            });

            return view('novosite.pages.page-show', compact('page', 'latestPosts'));
        } else {
            return redirect()->route('site.home');
        }
    }

    public function postList(Request $request)
    {
        $searchString = $request->input('qry');
        $posts = null;
        if (empty($searchString)) {
            $posts = WebPost::where('status', 'published')->orderByDesc('id')->paginate(25)->withQueryString();
        } else {
            $posts = WebPost::where('status', 'published')->search($searchString)->orderByDesc('id')->paginate(25)->withQueryString();
        }
        return view('site.pages.post-list', compact('posts', 'searchString'));
    }

    public function postShow($slug)
    {
        $post = WebPost::where('slug', $slug)->where('status', 'published')->first();

        if ($post) {
            WebPost::withoutTimestamps(function () use ($post) {
                $post->disableLogging();
                $post->increment('hits', 1);
            });

            return view('site.pages.post-show', compact('post'));
        } else {
            return redirect()->route('site.home');
        }
    }

    public function documentList($type)
    {
        $check = new DocumentController();

        if ($check->checkType($type)) {
            $documents = Document::where('type', $type)->orderByDesc('year')->orderByDesc('title')->paginate(25)->withQueryString();
            return view('site.pages.document-list', compact('documents'));
        }
        return redirect()->route('site.home');
    }


    public function normativeInstructionList($type = false)
    {
        $instructions = NormativeInstruction::orderBy('year', 'DESC')
            ->orderBy('number', 'DESC')
            ->paginate(25)
            ->withQueryString();
        return view('site.pages.document-normative-instruction-list', compact('instructions'));
    }
}
