<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OrderScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  Builder  $builder
     * @param  Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        $table = $model->getTable();
        $builder->orderByDesc("{$table}.order")
            ->orderByDesc("{$table}.updated_at")
            ->orderByDesc("{$table}.created_at")
            ->orderByDesc("{$table}.id");
    }
}
