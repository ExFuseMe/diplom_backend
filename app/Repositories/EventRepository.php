<?php

namespace App\Repositories;

use App\Http\Filters\EventFilter;
use App\Models\Event as Model;

class EventRepository extends CoreRepository
{
    protected function getModelClass(): string
    {
        return Model::class;
    }

    public function list(array $filterFields = [], $perPage = 10, $orderBy = 'created_at', $direction = 'desc')
    {
        $filter = app()->make(EventFilter::class, ['queryParams' => array_filter($filterFields)]);


        return $this->startConditions()->filter($filter)->orderBy($orderBy, $direction)->paginate($perPage);
    }

    public function show(int $eventId)
    {
        return $this->startConditions()->findOrFail($eventId);
    }
}
