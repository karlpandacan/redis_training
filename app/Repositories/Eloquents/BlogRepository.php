<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\BlogInterface;
use App\Repositories\Contracts\RepositoryInterface;

class BlogRepository extends Repository implements BlogInterface
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Blog';
    }
}
