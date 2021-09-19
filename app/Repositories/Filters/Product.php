<?php

namespace App\Repositories\Filters;

use Illuminate\Database\Eloquent\Builder;

class Product
{
    /**
     * Apply filter.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $search
     *
     * @return mixed $query
     */
    public static function apply(Builder $query, array $search)
    {
        return self::whereTitleLike($query, $search['title'] ?? null);
    }

    /**
     * Where title.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $search
     *
     * @return mixed $query
     */
    public static function whereTitleLike(Builder $query, ?string $value)
    {
        return $query->where('title', 'like', "%{$value}%");
    }
}
