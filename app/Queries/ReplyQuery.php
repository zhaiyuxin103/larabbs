<?php

namespace App\Queries;

use App\Models\Reply;
use Spatie\QueryBuilder\QueryBuilder;

class ReplyQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(Reply::query());

        $this->allowedIncludes(['user', 'topic.user', 'children.children']);
    }
}
