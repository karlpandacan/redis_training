<?php

namespace App\Http\Controllers;

use Cache;
use Redis;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\Contracts\BlogInterface as BlogRepository;

class BlogController extends Controller
{

    private $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->middleware('guest');
    }

    public function index()
    {
        $storage = Redis::connection();
        $popular = $storage->zRevRange('articleViews', 0, -1);
        foreach ($popular as $value) {
            $id = str_replace('article:', '', $value);
            echo "Article " . $id . "is popular <br>";
        }
    }

    public function show($id)
    {
        $storage = Redis::Connection();
        if ($storage->zScore('articleViews', 'article:' . $id)) {
            $storage->pipeline(function ($pipe) use ($id) {
                $pipe->zIncrBy('articleViews', 1, 'article:' . $id);
                $pipe->incr('article:' . $id . ':views');
            });
        } else {
            $views = $storage->incr('article:' . $id . ':views');
            $storage->zIncrBy('articleViews', 1, 'article:' . $id);
        }
        return "This is an article with id: " . $id . " it has " . $views . " views";
    }

    public function showAllCached()
    {
//        ini_set('xdebug.max_nesting_level', 200);
//        $blogs = Cache::remember('blog_posts_cache', 1, function(){
//            return view('blogs.view_cached', ['blogs' => Blog::latest()->paginate(15)]);
//        });
        dd($this->blogRepository->all());
        return view('blogs.view_cached', ['blogs' => $blogs]);
    }
}
