<?php

namespace App\Services;

use App\Models\Event;
use App\Repositories\EventRepository;

class EventService
{
    public function list(
        string $search = '',
        int $perPage = 10,
        string $orderBy = 'created_at',
        string $sortBy = 'desc'
    ) {
        $repository = new EventRepository();

        return $repository->list($search, $perPage, $orderBy, $sortBy);
    }

    public function create(array $validated)
    {
        return Event::create($validated);
    }

    public function view(int $eventId)
    {
        $repository = new EventRepository();

        return $repository->show($eventId);
    }

    public function update(array $validated, Event $event): bool
    {
        return $event->update($validated);
    }

    public function delete(Event $event): ?bool
    {
        return $event->delete();
    }
}
