<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;

class IndividuClassFilter extends Filter
{
    /**
     * Modify the current query when the filter is used
     *
     * @param Builder $query Current query
     * @param $value Value selected by the user
     * @return Builder Query modified
     */
    public function apply(Builder $query, $value, $request): Builder
    {
        return $query->where('class', $value);
    }

    /**
     * Defines the title and value for each option
     *
     * @return Array associative array with the title and values
     */
    public function options(): array
    {
        return [
            'ICTU A' => 'ICTU A',
            'ICTU B' => 'ICTU B',
            'ICTU C' => 'ICTU C',
            'ICTU D' => 'ICTU D',
            'JUNIOR' => 'JUNIOR',
            'SENIOR' => 'SENIOR',
        ];
    }

    public $title = "Class";
}
