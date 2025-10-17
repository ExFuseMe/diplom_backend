<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventFormFieldRequest;
use App\Http\Requests\UpdateEventFormFieldRequest;
use App\Models\EventFormField;

class EventFormFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventFormFieldRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EventFormField $eventFormField)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventFormField $eventFormField)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventFormFieldRequest $request, EventFormField $eventFormField)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventFormField $eventFormField)
    {
        //
    }
}
