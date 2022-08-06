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
                    <loc>'.route('home.index', https:true).'</loc>
                    <changefreq>daily</changefreq>
                    <lastmod>'.date('c').'</lastmod>
                    <priority>1</priority>
                </url>';
        $xml .= '<url>
                    <loc>'.route('home.article.all', https:true).'</loc>
                    <changefreq>daily</changefreq>
                    <lastmod>'.date('c').'</lastmod>
                    <priority>0.9</priority>
                </url>';
        $xml .= '<url>
                    <loc>'.route('auth.login.view', https:true).'</loc>
                    <changefreq>daily</changefreq>
                    <lastmod>'.date('c').'</lastmod>
                    <priority>0.9</priority>
                </url>';
        $xml .= '<url>
                    <loc>'.route('auth.register.view', https:true).'</loc>
                    <changefreq>daily</changefreq>
                    <lastmod>'.date('c').'</lastmod>
                    <priority>0.9</priority>
                </url>';
        $xml .= '<url>
                    <loc>'.route('home.about.index', https:true).'</loc>
                    <changefreq>daily</changefreq>
                    <lastmod>'.date('c').'</lastmod>
                    <priority>0.9</priority>
                </url>';
        $xml .= '<url>
                    <loc>'.route('home.contact.index', https:true).'</loc>
                    <changefreq>daily</changefreq>
                    <lastmod>'.date('c').'</lastmod>
                    <priority>0.9</priority>
                </url>';
        $articles = Article::orderBy('created_at', 'DESC')->get(['id', 'title']);
        $tags = Tag::orderBy('created_at', 'DESC')->get(['id', 'name']);
        $topics = Topic::orderBy('created_at', 'DESC')->get(['id', 'name']);
        foreach ($articles as $article) {
            $xml .= '<url>
                        <loc>'.route('home.article.show', [$article->id, dash_space($article->title)], https:true).'</loc>
                        <changefreq>daily</changefreq>
                        <lastmod>'.date('c').'</lastmod>
                        <priority>0.8</priority>
                    </url>';
        }
        foreach ($topics as $topic) {
            $xml .= '<url>
                        <loc>'.route('home.topic.show', [$topic->id, dash_space($topic->name)], https:true).'</loc>
                        <changefreq>daily</changefreq>
                        <lastmod>'.date('c').'</lastmod>
                        <priority>0.8</priority>
                    </url>';
        }
        foreach ($tags as $tag) {
            $xml .= '<url>
                        <loc>'.route('home.tag.index', [$tag->id, dash_space($tag->name)], https:true).'</loc>
                        <changefreq>daily</changefreq>
                        <lastmod>'.date('c').'</lastmod>
                        <priority>0.8</priority>
                    </url>';
        }
        $xml .= '</urlset>';

        return $xml;
    }
}
