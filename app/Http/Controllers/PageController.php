<?php

namespace App\Http\Controllers;

use App\Models\WebPage;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function show(Request $request, $slug) {
        $page = WebPage::where('slug', $slug)->first();

        return view('page', compact('page'));
    }
}
