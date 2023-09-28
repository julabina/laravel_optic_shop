<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\PostCommentRequest;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(string $cat, int $id, PostCommentRequest $request): RedirectResponse
    {
        Comment::create([
            'user_id' => $request->user()->id,
            'product_id' => $id,
            'content' => $request->content,
        ]);

        $request->session()->put('commentTab', true);

        return redirect(route('product.show', ['cat' => $cat, 'id' => $id]));
    }

    public function edit(string $cat, int $id, PostCommentRequest $request): RedirectResponse
    {
        $comment = Comment::find($id);

        if ($comment !== null) {
            if ($comment->user_id === $request->user()->id) {
                $comment->content = $request->content;
                $comment->save();

                $request->session()->put('commentTab', true);
            }
        }

        return redirect(route('product.show', ['cat' => $cat, 'id' => $comment->product_id]));
    }

    public function delete(string $cat, int $id, Request $request): redirectResponse
    {
        $comment = Comment::find($id);

        if ($comment !== null) {
            if ($comment->user_id === $request->user()->id) {
                $comment->delete();

                $request->session()->put('commentTab', true);
            }
        }

        return redirect(route('product.show', ['cat' => $cat, 'id' => $comment->product_id]));
    }
}
