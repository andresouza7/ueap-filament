<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WebPage;
use App\Models\WebPost;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return redirect()->back()->with('error', 'Please enter a search query.');
        }

        $htmlQuery = htmlentities($query);

        $webPosts = WebPost::selectRaw(
            "*, ts_headline('portuguese', text, plainto_tsquery('portuguese', ?)) as snippet",
            [$htmlQuery]
        )
            // where('title', 'like', "%{$query}%")
            ->Where('text', 'ilike', "%{$htmlQuery}%")
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $webPages = WebPage::selectRaw(
            "*, ts_headline('portuguese', text, plainto_tsquery('portuguese', ?)) as snippet",
            [$htmlQuery]
        )
            // where('title', 'like', "%{$query}%")
            ->Where('text', 'ilike', "%{$htmlQuery}%")
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $results = [
            'Postagens' => [
                'items' => $webPosts,
                'route' => 'post'
            ],
            'Páginas' => [
                'items' => $webPages,
                'route' => 'page'
            ]
        ];

        return view('site.pages.search-list', compact('results', 'query'));
    }
}
