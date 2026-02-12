<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\WebMenu;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'menus' => WebMenu::where('status', 'published')
                ->whereHas('menu_place', fn($q) => $q->where('slug', 'topo'))
                ->with(['items' => function ($query) {
                    $query->whereNull('menu_parent_id')
                        ->where('status', 'published')
                        ->orderBy('position')
                        ->with(['sub_itens' => function ($q) {
                            $q->where('status', 'published')->orderBy('position');
                        }]);
                }])
                ->orderBy('position')
                ->first(),
            'latestPosts' => \App\Models\WebPost::where('status', 'published')
                ->where('type', 'news')
                ->latest()
                ->take(4)
                ->get(),
            'categories' => \App\Models\WebCategory::has('posts')
                ->inRandomOrder()
                ->take(6)
                ->get(),
        ];
    }
}
