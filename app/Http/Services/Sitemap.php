<?php

namespace App\Http\Services;

use App\Models\Article;
use App\Models\Tag;
use App\Models\Topic;

class Sitemap
{
    public static function get()
    {
        $xml = '<?xml  version="1.0" encoding="UTF-8"?>
                    <urlset
                        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
                        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

        $xml .= '<url>
                    <loc>'.route('home.index').'</loc>
                    <changefreq>daily</changefreq>
                    <lastmod>'.date('c').'</lastmod>
                    <priority>1</priority>
                </url>';
        $xml .= '<url>
                    <loc>'.route('home.article.all').'</loc>
                    <changefreq>daily</changefreq>
                    <lastmod>'.date('c').'</lastmod>
                    <priority>0.9</priority>
                </url>';
        $xml .= '<url>
                    <loc>'.route('auth.login.view').'</loc>
                    <changefreq>daily</changefreq>
                    <lastmod>'.date('c').'</lastmod>
                    <priority>0.9</priority>
                </url>';
        $xml .= '<url>
                    <loc>'.route('auth.register.view').'</loc>
                    <changefreq>daily</changefreq>
                    <lastmod>'.date('c').'</lastmod>
                    <priority>0.9</priority>
                </url>';
        $xml .= '<url>
                    <loc>'.route('home.about.index').'</loc>
                    <changefreq>daily</changefreq>
                    <lastmod>'.date('c').'</lastmod>
                    <priority>0.9</priority>
                </url>';
        $xml .= '<url>
                    <loc>'.route('home.contact.index').'</loc>
                    <changefreq>daily</changefreq>
                    <lastmod>'.date('c').'</lastmod>
                    <priority>0.9</priority>
                </url>';
        $articles = Article::orderBy('created_at', 'DESC')->get();
        $tags = Tag::orderBy('created_at', 'DESC')->get(['id', 'name']);
        $topics = Topic::orderBy('created_at', 'DESC')->get(['id', 'name']);
        foreach ($articles as $article) {
            $xml .= '<url>
                        <loc>'.route('home.url', [$article->url()->token]).'</loc>
                        <changefreq>daily</changefreq>
                        <lastmod>'.date('c').'</lastmod>
                        <priority>0.8</priority>
                    </url>';
        }
        foreach ($topics as $topic) {
            $xml .= '<url>
                        <loc>'.route('home.topic.show', [$topic->id, dash_space($topic->name)]).'</loc>
                        <changefreq>daily</changefreq>
                        <lastmod>'.date('c').'</lastmod>
                        <priority>0.8</priority>
                    </url>';
        }
        foreach ($tags as $tag) {
            $xml .= '<url>
                        <loc>'.route('home.tag.index', [$tag->id, dash_space($tag->name)]).'</loc>
                        <changefreq>daily</changefreq>
                        <lastmod>'.date('c').'</lastmod>
                        <priority>0.8</priority>
                    </url>';
        }
        $xml .= '</urlset>';

        return $xml;
    }
}
