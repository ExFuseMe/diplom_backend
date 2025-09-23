<?php

namespace App\Repositories;

use App\Models\Event as Model;
class EventRepository extends CoreRepository
{
    protected function getModelClass(): string
    {
        return Model::class;
    }

    public function list(string $search = '', $perPage = 10, $orderBy = 'created_at', $direction = 'desc')
    {
        return $this->search($search)->paginate($perPage);
    }
}
