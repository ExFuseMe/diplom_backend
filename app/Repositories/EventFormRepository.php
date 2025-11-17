<?php

namespace App\Repositories;

use App\Models\EventForm as Model;

class EventFormRepository extends CoreRepository
{
    protected function getModelClass(): string
    {
        return Model::class;
    }

    public function list(string $search = '', $perPage = 10, $orderBy = 'created_at', $direction = 'desc')
    {
        return $this->search($search)->with(['fields'])->orderBy($orderBy, $direction)->paginate($perPage);
    }

    public function show(int $eventFormId)
    {
        return $this->startConditions()->with(['fields'])->findOrFail($eventFormId);
    }

    public function getByEventId(int $id)
    {
        return $this->startConditions()
            ->where('event_id', $id)
            ->with(['fields'])->paginate();
    }
}
