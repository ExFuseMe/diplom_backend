<?php

namespace App\Services;

use App\Models\Event;
use App\Models\EventForm;
use App\Models\EventFormField;
use App\Repositories\EventFormRepository;
use App\Repositories\EventRepository;

class EventFormService
{
    public function list(
        string $search = '',
        int $perPage = 10,
        string $orderBy = 'created_at',
        string $sortBy = 'desc'
    ) {
        $repository = new EventFormRepository();

        return $repository->list($search, $perPage, $orderBy, $sortBy);
    }

    public function create(array $validated)
    {
        $fields = $validated['fields'];

        $eventForm = EventForm::create([
            'event_id' => $validated['event_id'],
        ]);

        foreach ($fields as $field) {
            $eventForm->fields()->create($field);
        }

        $repository = new EventFormRepository();
        return $repository->show($eventForm->id);
    }

    public function show(int $id)
    {
        $repository = new EventFormRepository();
        return $repository->show($id);
    }

    public function update(EventForm $eventForm, array $validated)
    {
        $eventForm->fields()->delete();

        foreach ($validated['fields'] as $field) {
            $eventForm->fields()->create($field);
        }
        $repository = new EventFormRepository();

        return $repository->show($eventForm->id);
    }
}
