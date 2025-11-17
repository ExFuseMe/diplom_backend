<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventFormRequest;
use App\Http\Requests\UpdateEventFormRequest;
use App\Http\Resources\EventFormResource;
use App\Models\Event;
use App\Models\EventForm;
use App\Services\EventFormService;
use App\Services\EventService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class EventFormController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request, EventFormService $eventFormService)
    {
        $this->authorize('viewAny', EventForm::class);

        $search = $request->get('search', '');
        $perPage = $request->query('perPage', 10);
        $orderBy = $request->query('orderBy', 'created_at');
        $direction = $request->query('direction', 'desc');


        $forms = $eventFormService->list($search, $perPage, $orderBy, $direction);

        return EventFormResource::collection($forms);
    }

    public function store(StoreEventFormRequest $request, EventFormService $eventFormService)
    {
        $this->authorize('create', Event::class);

        $validated = $request->validated();
        $form = $eventFormService->create($validated);

        return new EventFormResource($form);
    }

    public function show(EventForm $eventForm, EventFormService $eventFormService)
    {
        $this->authorize('view', $eventForm);

        $eventForm = $eventFormService->show($eventForm->id);

        return new EventFormResource($eventForm);
    }

    public function update(UpdateEventFormRequest $request, EventForm $eventForm, EventFormService $eventFormService)
    {
        $this->authorize('update', $eventForm);

        $validated = $request->validated();
        $eventForm = $eventFormService->update($eventForm, $validated);

        return new EventFormResource($eventForm);
    }


    public function destroy(EventForm $eventForm)
    {
        $this->authorize('delete', $eventForm);

        $eventForm->delete();
        return response(null, 204);
    }

    public function eventForms(Event $event, EventService $eventService)
    {
        $this->authorize('viewAny', EventForm::class);

        $eventService->getEventForms($event);
    }
}
