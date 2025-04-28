<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function reply(Request $request, Comment $comment)
    {
        $request->validate([
            'comments' => 'required|string|max:1000',
        ]);

        Comment::create([
            'task_id' => $comment->task_id,
            'user_id' => Auth::id(),
            'parent_id' => $comment->id,
            'comments' => $request->comments,
        ]);

        return redirect()->back()->with('success', 'Reply posted successfully.');
    }
}
