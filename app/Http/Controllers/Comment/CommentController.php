<?php

namespace App\Http\Controllers\Comment;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Comment;

class CommentController extends Controller
{
    public function comment(Request $request)
    {
    	$this->validate($request, [
            'name' => 'required|max:60|min:2',
            'email' => 'required|email',
            'body' => 'required'
        ]);

        $comment = Comment::create([
        	'name'	=> $request->name,
        	'email'	=> $request->email,
        	'body'	=> $request->body,
    	]);

    	if($comment)
    	{
    		return back()->with('message', 'Thank you for your feedback.');
    	} else {
    		return back()->with('error', 'Something Wrong.');
    	}

    }
}
