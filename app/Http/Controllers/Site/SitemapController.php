<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\WebPost;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [];

        // Static Pages
        $staticRoutes = [
            'site.home',
            'site.post.list',
            'site.documentos.ordinance.list',
            'site.documentos.resolution.list',
            'site.documentos.calendar.list',
        ];

        foreach ($staticRoutes as $route) {
            $urls[] = [
                'loc' => route($route),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '0.8',
            ];
        }

        // Course Lists
        $courses = ['graduacao', 'pos', 'ext'];
        foreach ($courses as $slug) {
            $urls[] = [
                'loc' => route('site.documentos.course.list', $slug),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        }

        // Dynamic Posts (News, Events, Pages)
        WebPost::where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->chunk(100, function ($posts) use (&$urls) {
                foreach ($posts as $post) {
                    $routeName = $post->type === 'page' ? 'site.page.show' : 'site.post.show';

                    $urls[] = [
                        'loc' => route($routeName, $post->slug),
                        'lastmod' => $post->updated_at->toAtomString(),
                        'changefreq' => 'weekly',
                        'priority' => $post->type === 'page' ? '0.7' : '0.6',
                    ];
                }
            });

        // Generate XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($urls as $url) {
            $xml .= '<url>';
            $xml .= '<loc>' . $url['loc'] . '</loc>';
            $xml .= '<lastmod>' . $url['lastmod'] . '</lastmod>';
            $xml .= '<changefreq>' . $url['changefreq'] . '</changefreq>';
            $xml .= '<priority>' . $url['priority'] . '</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'text/xml',
        ]);
    }
}
