<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Events\EventFilterRequest;
use App\Http\Requests\Events\StoreEventRequest;
use App\Http\Requests\Events\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class EventController extends Controller
{
    use AuthorizesRequests;


    public function index(EventFilterRequest $request, EventService $eventService): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Event::class);

        $validated = $request->validated();
        $filterFields = Arr::except($validated, ['perPage', 'orderBy', 'direction']);

        $perPage = empty($validated['perPage']) ? 10 : $validated['perPage'];
        $orderBy = empty($validated['orderBy']) ? 'created_at' : $validated['orderBy'];
        $direction = empty($validated['direction']) ? 'desc' : $validated['direction'];


        $events = $eventService->list($filterFields, $perPage, $orderBy, $direction);

        return EventResource::collection($events);
    }

    public function store(StoreEventRequest $request, EventService $eventService): EventResource
    {
        $this->authorize('create', Event::class);
        $validated = $request->validated();

        $event = $eventService->create($validated);

        return new EventResource($event);
    }

    public function show(Event $event, EventService $eventService): EventResource
    {
        $this->authorize('view', $event);

        $event = $eventService->view($event->id);

        return new EventResource($event);
    }

    public function update(UpdateEventRequest $request, Event $event, EventService $eventService): EventResource
    {
        $this->authorize('update', $event);
        $validated = $request->validated();
        $eventService->update($validated, $event);
        $event = Event::find($event->id);

        return new EventResource($event);
    }

    public function destroy(Event $event, EventService $eventService): Response
    {
        $this->authorize('delete', $event);
        $eventService->delete($event);

        return response()->noContent();
    }
}
