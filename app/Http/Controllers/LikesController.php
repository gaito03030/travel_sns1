<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LikesController extends Controller
{
    public function store($post_id)
    {
        $user = User::find(auth()->user()->id);
        if (!$user->is_like($post_id)) {
            $user->like_posts()->attach($post_id);
        }
        return back();
    }

    public function destroy($post_id)
    {
        $user = User::find(auth()->user()->id);
        if ($user->is_like($post_id)) {
            $user->like_posts()->detach($post_id);
        }
        return back();
    }
}
