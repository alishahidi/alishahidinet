<?php

namespace App\Http\Services;

use App\Models\Article;
use Ramsey\Uuid\Uuid;

class Rss
{
    public static function streamArticles()
    {
        $articles = Article::orderBy('created_at', 'DESC')->limit(0, 10)->get();
        $uuid = Uuid::uuid4()->toString();
        $name = date('Y_m_d_M_i_s_').$uuid;
        header('Content-type: application/rss+xml; charset=UTF-8');
        header("Content-Disposition: attachment; filename=$name.rss");
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        $xml = "<?xml  version='1.0' encoding='UTF-8'?>
            <rss xmlns:content='http://purl.org/rss/1.0/modules/content/' xmlns:wfw='http://wellformedweb.org/CommentAPI/' xmlns:dc='http://purl.org/dc/elements/1.1/' xmlns:atom='http://www.w3.org/2005/Atom' xmlns:sy='http://purl.org/rss/1.0/modules/syndication/' xmlns:slash='http://purl.org/rss/1.0/modules/slash/' version='2.0'>
            <channel>
            <title>علی شهیدی - ۱۰ مقاله آخر</title>
            <atom:link href='".route('home.rss')."' rel='self' type='application/rss+xml'/>
            <lastBuildDate>".date('D, d M Y H:i:s T').'</lastBuildDate>
            <generator>alishahidinet Rss generator</generator>
            <link>'.currentDomain().'</link>
            <description>وبسایت شخصی علی شهیدی - ۱۰ مقاله آخر</description>
            <language>fa-ir</language>';
        foreach ($articles as $article) {
            $title = hpd($article->title);
            $link = route('home.article.show', [$article->id, hpd($article->title)]);
            $description = hpd($article->description);
            $category = hpd($article->topic()->name);
            $content = hpd($article->content);
            $author = hpd($article->user()->name);
            $pubDate = date('D, d M Y H:i:s T', strtotime($article->created_at));
            $xml .= "<item>
                        <title>$title</title>
                        <link>$link</link>
                        <description>$description</description>
                        <category>$category</category>
                        <dc:creator><![CDATA[ $author ]]></dc:creator>
                        <pubDate>$pubDate</pubDate>
                        <content:encoded><![CDATA[ $content ]]></content:encoded>
                    </item>";
        }
        $xml .= '</channel></rss>';
        file_put_contents('php://output', $xml);
    }
}
