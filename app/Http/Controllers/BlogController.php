<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function show($id)
    {
        $storage = Redis::Connection();
        if ($storage->zScore('articleViews', 'article:' . $id)) {
            $storage->pipeline(function ($pipe) use ($id){
                $pipe->zIncrBy('articleViews:', 1, 'article:' . $id);
                $pipe->incr('article:' . $id . ':views');
            });
        } else {
            $views = $storage->incr('article:' . $id . ':views');
            $storage->zIncrBy('articleViews:', 1, 'article:' . $id);
        }
        return "This is an article with id: " . $id . " it has " . $views . " views";
    }
}
