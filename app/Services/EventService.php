<?php

namespace App\Services;

use App\Repositories\EventRepository;

class EventService
{
    public function listEvents(
        string $search = '',
        int $perPage = 10,
        string $orderBy = 'created_at',
        string $sortBy = 'desc'
    ) {
        $repository = new EventRepository();

        return $repository->list($search, $perPage, $orderBy, $sortBy);
    }
}
