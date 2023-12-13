<?php

namespace App\Http\Controllers;
use App\Http\Requests\Facility\StoreRequest;
use App\Http\Requests\Facility\UpdateRequest;
use App\Http\Resources\Facility\FacilityResource;
use App\Models\Facility;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;


class FacilityController extends Controller
{
    public function index(): Response
    {
        $facilities = Facility::all();

        return Inertia::render('Admin/Facilities/FacilityIndex', [
            'facilities' => FacilityResource::collection($facilities)
        ]);
    }

    public function create(): Response
    {
        $this->authorize('create', Facility::class);
        return Inertia::render('Admin/Facilities/Create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Facility::class);
        Facility::create($request->validated());

        return to_route('facilities.index');
    }

    public function edit(Facility $facility): Response
    {
        $this->authorize('update', $facility);
        return Inertia::render('Admin/Facilities/Edit', [
            'facility' => new FacilityResource($facility)
        ]);
    }

    public function update(UpdateRequest $request, Facility $facility): RedirectResponse
    {
        $this->authorize('update', $facility);
        $facility->update($request->validated());

        return to_route('facilities.index');
    }

    public function destroy(Facility $facility): RedirectResponse
    {
        $this->authorize('delete', $facility);
        $facility->delete();
        return back();
    }
}
