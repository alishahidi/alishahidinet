<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\UserCommentRequest;
use App\Http\Services\Rss;
use App\Http\Services\Url;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\Topic;
use System\Auth\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'DESC')->limit(0, 5)->get();
        $tags = Tag::orderBy('created_at', 'DESC')->randomOrder('DESC')->limit(0, 20)->get();

        return view('app.index', compact('articles', 'tags'));
    }

    public function url($token)
    {
        return redirect(Url::get($token));
    }

    public function feed()
    {
        Rss::streamArticles();
        exit;
    }

    public function about()
    {
        $services = Service::orderBy('created_at', 'DESC')->get();
        $skills = Skill::orderBy('created_at', 'DESC')->get();
        $projects = Project::orderBy('created_at', 'DESC')->get();
        $articlesCount = Article::count();

        return view('app.about', compact('services', 'skills', 'projects', 'articlesCount'));
    }

    public function allArticle()
    {
        $articles = Article::orderBy('created_at', 'DESC')->paginate(5);
        $articlesCount = Article::count();
        $title = 'مقالات';

        return view('app.articles', compact('articles', 'articlesCount', 'title'));
    }

    public function article($id, $slug)
    {
        $article = Article::find($id);
        if (! $article) {
            return error_404();
        }
        $relatedArticles = Article::where('topic_id', $article->topic_id)->orderBy('created_at', 'DESC')->limit(0, 3)->get();

        return view('app.article', compact('article', 'relatedArticles'));
    }

    public function comment($id)
    {
        Auth::check();
        $request = new UserCommentRequest();
        $inputs = $request->all();
        $inputs['article_id'] = $id;
        $inputs['status'] = 0;
        $inputs['user_id'] = Auth::user()->id;
        Comment::create($inputs);
        flash('comment_store', 'کامنت ثبت شد و پس از تایید به نمایش در خواهد آمد.');

        return back();
    }

    public function topic($id, $slug)
    {
        $topic = Topic::find($id);
        if (! $topic) {
            return error_404();
        }
        $articles = $topic->articles()->orderBy('created_at', 'DESC')->paginate(5);
        $articlesCount = Article::count();
        $title = $topic->name;

        return view('app.articles', compact('articles', 'articlesCount', 'title'));
    }

    public function tag($id, $slug)
    {
        $tag = Tag::find($id);
        if (! $tag) {
            return error_404();
        }
        $articles = $tag->articles()->orderBy('created_at', 'DESC')->paginate(5);
        $articlesCount = Article::count();
        $title = $tag->name;

        return view('app.articles', compact('articles', 'articlesCount', 'title'));
    }
}
