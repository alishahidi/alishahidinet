<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TopicRequest;
use App\Models\Topic;

class TopicController extends AdminController
{
    public function index()
    {
        $topics = Topic::orderBy('created_at', 'DESC')->get();

        return view('admin.topic.index', compact('topics'));
    }

    public function create()
    {
        return view('admin.topic.create');
    }

    public function store()
    {
        $request = new TopicRequest();
        $inputs = $request->all();
        Topic::create($inputs);

        return redirect(route('admin.topic.index'));
    }

    public function edit($id)
    {
        $topic = Topic::find($id);

        return view('admin.topic.edit', compact('topic'));
    }

    public function update($id)
    {
        $request = new TopicRequest();
        $inputs = $request->all();
        $inputs['id'] = $id;
        Topic::update($inputs);

        return redirect(route('admin.topic.index'));
    }

    public function destroy($id)
    {
        Topic::delete($id);

        return back();
    }
}
