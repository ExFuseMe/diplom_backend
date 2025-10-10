<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class EventController extends Controller
{
    use AuthorizesRequests;


    public function index(Request $request, EventService $eventService)
    {
        $this->authorize('viewAny', Event::class);

        $search = $request->get('search', '');
        $perPage = $request->query('perPage', 10);
        $orderBy = $request->query('orderBy', 'created_at');
        $direction = $request->query('direction', 'desc');


        $events = $eventService->list($search, $perPage, $orderBy, $direction);

        return EventResource::collection($events);
    }

    public function store(StoreEventRequest $request, EventService $eventService)
    {
        $this->authorize('create', Event::class);
        $validated = $request->validated();

        $event = $eventService->create($validated);

        return new EventResource($event);
    }

    public function show(Event $event, EventService $eventService)
    {
        $this->authorize('view', $event);

        $event = $eventService->view($event->id);

        return new EventResource($event);
    }

    public function update(UpdateEventRequest $request, Event $event, EventService $eventService)
    {
        $this->authorize('update', $event);
        $validated = $request->validated();
        $eventService->update($validated, $event);
        $event = Event::find($event->id);

        return new EventResource($event);
    }
    public function destroy(Event $event, EventService $eventService)
    {
        $this->authorize('delete', $event);
        $eventService->delete($event);

        return response()->noContent();
    }
}
