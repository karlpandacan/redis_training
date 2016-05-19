<?php

namespace App\Repositories\Eloquents;


use Cache;
use Redis;
use App\Repositories\Contracts\BlogInterface;
use App\Repositories\Contracts\RepositoryInterface;

class BlogRepository extends Repository implements BlogInterface
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function fetchAll()
    {
        $result = Cache::remember('blog_posts_cache', 1, function(){
            return $this->model->all();
        });
        return $result;
    }
}
