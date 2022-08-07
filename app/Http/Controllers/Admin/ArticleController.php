<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ArticleRequest;
use App\Http\Services\Url;
use App\Models\Article;
use App\Models\Tag;
use App\Models\TagArticle;
use App\Models\Topic;
use System\Auth\Auth;
use System\Image\Image;
use System\Request\Request;

class ArticleController extends AdminController
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'DESC')->get();

        return view('admin.article.index', compact('articles'));
    }

    public function create()
    {
        $topics = Topic::orderBy('created_at', 'DESC')->get();

        return view('admin.article.create', compact('topics'));
    }

    private function getTagifyArray($tags)
    {
        $tags = json_decode(d($tags), true);
        $tagArray = [];
        foreach ($tags as $tag) {
            array_push($tagArray, $tag['value']);
        }

        return $tagArray;
    }

    public function store()
    {
        $request = new ArticleRequest();
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->id;
        $tags = $this->getTagifyArray($inputs['tags']);
        unset($inputs['tags']);
        $inputs['image'] = [
            'thumbnail' => Image::make('image', 'images/article', true)->resize(390, 340)->text('alishahidinet.ir', x: 10, y: 10, size: 19)->saveFtp(quality: 100, unique: true, dateFormat: true),
            'main' => Image::make('image', 'images/article', true)->resize(560, 480)->text('alishahidinet.ir', x: 8, y: 10, size: 22)->saveFtp(quality: 100, unique: true, dateFormat: true),
        ];
        $inputs['view'] = 0;
        $article = Article::create($inputs);
        foreach ($tags as $tag) {
            $findTag = Tag::where('name', $tag)->get()[0];
            if (! $findTag) {
                Tag::create(['name' => $tag]);
            }
        }
        foreach ($tags as $tag) {
            $findTag = Tag::where('name', $tag)->get()[0];
            TagArticle::create(['tag_id' => $findTag->id, 'article_id' => $article->insertId]);
        }
        $updateArticle = Article::find($article->insertId);
        $updateArticle->url_id = Url::set('home.article.show', [$article->insertId, dash_space($article->title)]);
        $updateArticle->save();

        return redirect(route('admin.article.index'));
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $topics = Topic::orderBy('created_at', 'DESC')->get();

        return view('admin.article.edit', compact('article', 'topics'));
    }

    public function update($id)
    {
        $request = new ArticleRequest();
        $article = Article::find($id);
        $inputs = $request->all();
        $inputs['id'] = $id;
        $articleTags = $article->tags();
        $tags = $this->getTagifyArray($inputs['tags']);
        unset($inputs['tags']);
        if ($request->file('image')['tmp_name']) {
            $inputs['image'] = [
                'thumbnail' => Image::make('image', 'images/article', true)->resize(390, 340)->text('alishahidinet.ir', x: 10, y: 10, size: 19)->saveFtp(quality: 100, unique: true, dateFormat: true),
                'main' => Image::make('image', 'images/article', true)->resize(560, 480)->text('alishahidinet.ir', x: 8, y: 10, size: 22)->saveFtp(quality: 100, unique: true, dateFormat: true),
            ];
        }
        foreach ($articleTags as $articleTag) {
            if (in_array($articleTag->name, $tags)) {
                continue;
            }
            $tagArticle = TagArticle::where('article_id', $id)->where('tag_id', $articleTag->id)->get()[0];
            TagArticle::delete($tagArticle->id);
        }
        foreach ($tags as $tag) {
            $findTag = Tag::where('name', $tag)->get()[0];
            if (! $findTag) {
                Tag::create(['name' => $tag]);
            }
            $findTag = Tag::where('name', $tag)->get()[0];
            $findTagArticle = TagArticle::where('article_id', $id)->where('tag_id', $findTag->id)->get()[0];
            if (! $findTagArticle) {
                TagArticle::create(['tag_id' => $findTag->id, 'article_id' => $id]);
            }
        }
        Article::update($inputs);

        return redirect(route('admin.article.index'));
    }

    public function destroy($id)
    {
        new Request();
        Article::delete($id);

        return back();
    }
}
