<?php

namespace App\Http\Controllers;

use App\Http\Requests\Hotel\StoreRequest;
use App\Http\Requests\Hotel\UpdateRequest;
use App\Http\Resources\Facility\FacilityResource;
use App\Http\Resources\Hotel\HotelResource;
use App\Models\Facility;
use App\Models\Hotel;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class HotelController extends Controller
{
    public function index(): Response
    {

        $hotels = HotelResource::collection(Hotel::with('facilities')->get())->resolve();

        return Inertia::render('Admin/Hotels/HotelIndex',compact('hotels'));
    }

    public function create(): Response
    {
        $this->authorize('create', Hotel::class);
        $facilities = FacilityResource::collection(Facility::all())->resolve();

        return Inertia::render('Admin/Hotels/Create',compact('facilities'));

    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Hotel::class);
        $file = $request->file('poster_url');

        $poster_url = 'noimage.jpg';
        if ($file) {
            $extension = $file->getClientOriginalExtension();
            $poster_url = time() . '.' . $extension;
            $file->move('image/front/hotel/', $poster_url);
            Storage::put($poster_url, $poster_url, 'public');
        }
        $hotel = new Hotel([

            'hotel_name' => $request->get('hotel_name'),
            'description' => $request->get('description'),
            'address' => $request->get('address'),
            'poster_url' => $poster_url,
        ]);
        $hotel->save();


        if ($request->has('facilities')) {
            $hotel->facilities()->attach($request->facilities);
        }

        if ($hotel) {
            return to_route('hotels.index')->with('success', 'Hotel created successfully.');
        }
        return to_route('hotels.index')->with('error', 'Opps! Hotel Fail to Create!');

    }

    public function edit(Hotel $hotel): Response
    {
        $this->authorize('update', $hotel);


        $facilities = FacilityResource::collection(Facility::all())->resolve();
        return Inertia::render('Admin/Hotels/Edit',compact('hotel','facilities'));
    }

    public function update(UpdateRequest $request, Hotel $hotel): RedirectResponse
    {
        $this->authorize('update', $hotel);
        $file = $request->file('poster_url');
        if ($file) {
            $Hotel = Hotel::find($hotel->id);
            $this->delete_image('image/front/hotel/', $Hotel->poster_url);
            $extension = $file->getClientOriginalExtension();
            $poster_url = time() . '.' . $extension;
            $file->move('image/front/hotel/', $poster_url);
            $Hotel = array(
                'hotel_name' => $request->hotel_name,
                'description' => $request->description,
                'address' => $request->address,
                'poster_url' => $poster_url
            );

            if ($request->has('facilities')) {
                $hotel->facilities()->sync($request->facilities);
            }
            Hotel::findOrfail($hotel->id)->update($Hotel);

        }
        $Hotel = Hotel::find($hotel->id);
        $Hotel->hotel_name = $request->get('hotel_name');
        $Hotel->description = $request->get('description');
        $Hotel->address = $request->get('address');

        if ($file)
            $Hotel->poster_url = $poster_url;
        $Hotel->update();

        if ($request->has('facilities')) {
            $hotel->facilities()->sync($request->facilities);
        }
        return to_route('hotels.index')->with('success', 'Hotel updated successfully.');
    }

    public function destroy(Hotel $hotel): RedirectResponse
    {
        $this->authorize('delete', $hotel);
        $this->delete_image('image/front/hotel/', $hotel->poster_url);
        $hotel->facilities()->detach();
        $hotel->delete();
        return back()->with('danger', 'Hotel deleted successfully.');
    }

    private function delete_image($dossier, $image)
    {
        $destination = $dossier . $image;
        if (File::exists($destination)) {
            if ($image != 'noimage.jpg') {
                // Delete Image
                File::delete($destination);
                error_log('File::delete');
            } else {
                error_log('noimage else');
            }
        } else {
            error_log('File::existselse');
        }
    }
}
