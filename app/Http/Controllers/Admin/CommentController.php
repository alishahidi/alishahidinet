<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;

class CommentController extends AdminController
{
    public function index()
    {
        $approvedComments = Comment::where('status', 1)->orderBy('created_at', 'DESC')->get();
        $notApprovedComments = Comment::where('status', 0)->orderBy('created_at', 'DESC')->get();

        return view('admin.comment.index', compact('approvedComments', 'notApprovedComments'));
    }

    public function view($id)
    {
        $comment = Comment::find($id);

        return view('admin.comment.view', compact('comment'));
    }

    public function approved($id)
    {
        $comment = Comment::find($id);
        if ($comment->status) {
            $comment->status = 0;
        } else {
            $comment->status = 1;
        }
        $comment->save();

        return redirect(route('admin.comment.index'));
    }
}
