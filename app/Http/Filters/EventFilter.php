<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class EventFilter extends AbstractFilter
{
    public const string EVENT_TITLE = 'title';
    public const string EVENT_DESCRIPTION = 'description';

    protected function getCallbacks(): array
    {
        return [
            self::EVENT_TITLE => [$this, 'collectByEventTitle'],
            self::EVENT_DESCRIPTION => [$this, 'collectByEventDescription'],
        ];
    }

    public function collectByEventTitle(Builder $builder, $value): Builder
    {
        return $builder->where('title', 'ilike', "%{$value}%");
    }
    public function collectByEventDescription(Builder $builder, $value): Builder
    {
        return $builder->where('description', 'ilike', "%{$value}%");
    }
}
