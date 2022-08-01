<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\Panel\CommentRequest;
use App\Models\Comment;
use System\Auth\Auth;

class CommentController extends PanelController
{
    public function index()
    {
        $user = Auth::user();
        $approvedComments = $user->comments()->where('status', 1)->orderBy('created_at', 'DESC')->get();
        $notApprovedComments = $user->comments()->where('status', 0)->orderBy('created_at', 'DESC')->get();

        return view('panel.comment.index', compact('approvedComments', 'notApprovedComments'));
    }

    public function edit($id)
    {
        $comment = Comment::find($id);

        return view('panel.comment.edit', compact('comment'));
    }

    public function update($id)
    {
        $request = new CommentRequest();
        $inputs = $request->all();
        $inputs['id'] = $id;
        $inputs['status'] = 0;
        Comment::update($inputs);

        return redirect(route('panel.comment.index'));
    }

    public function destroy($id)
    {
        Comment::delete($id);

        return back();
    }
}
