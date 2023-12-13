<?php

namespace App\Http\Controllers;

use App\Http\Requests\Room\StoreRequest;
use App\Http\Requests\Room\UpdateRequest;
use App\Http\Resources\Facility\FacilityResource;
use App\Http\Resources\Hotel\HotelResource;
use App\Http\Resources\Room\RoomResource;
use App\Models\Facility;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;
class RoomController extends Controller
{
    public function index(): Response
    {
        $rooms = RoomResource::collection(Room::with('facilities')->join('hotels','rooms.hotel_id','hotels.id')
               ->select('hotels.hotel_name','rooms.*')
               ->orderBy('rooms.id')->get())->resolve();

   //    $rooms = RoomResource::collection(  DB::table('rooms')
   //          ->join('hotels','rooms.hotel_id','hotels.id')
    //            ->select('hotels.hotel_name','rooms.*')
     //           ->orderBy('rooms.id')->get())->resolve();


   //  $rooms = DB::table('rooms')
     //     ->join('hotels','rooms.hotel_id','hotels.id')
     //       ->select('hotels.hotel_name','rooms.*')
     //       ->orderBy('rooms.id')
     //     ->get();

      //  return response()->json($product);
        return Inertia::render('Admin/Rooms/RoomIndex',compact('rooms',));
    }

    public function create(): Response
    {
        $this->authorize('create', Room::class);
        $hotels = HotelResource::collection(Hotel::all())->resolve();
        $facilities = FacilityResource::collection(Facility::all())->resolve();
        return Inertia::render('Admin/Rooms/Create',compact('hotels','facilities'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {

        $this->authorize('create', Room::class);
        $file = $request->file('poster_url');

        $poster_url = 'noimage.jpg';
        if ($file) {
            $extension = $file->getClientOriginalExtension();
            $poster_url = time() . '.' . $extension;
            $file->move('image/front/room/', $poster_url);
            Storage::put($poster_url, $poster_url, 'public');
        }
        $room = new Room([

            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'floor_area' => $request->get('floor_area'),
            'type' => $request->get('type'),
            'price' => $request->get('price'),
            'hotel_id' => $request->get('hotel_id'),
            'poster_url' => $poster_url,
        ]);
        $room->save();
    //    $room= Room::create($request->validated());

        if ($request->has('facilities')) {
            $room->facilities()->attach($request->facilities);
        }

        if ($room) {
            return to_route('rooms.index')->with('success', 'Room created successfully.');
        }
        return to_route('rooms.index')->with('error', 'Opps! Room Fail to Create!');

    }

    public function edit(Room $room): Response
    {
        $this->authorize('update', $room);
        $hotels = HotelResource::collection(Hotel::all())->resolve();
        $facilities = FacilityResource::collection(Facility::all())->resolve();

        return Inertia::render('Admin/Rooms/Edit',compact('room','hotels','facilities'));
    }

    public function update(UpdateRequest $request, Room $room): RedirectResponse
    {
        $this->authorize('update', $room);
        $file = $request->file('poster_url');
        if ($file) {
            $Room = Room::find($room->id);
            $this->delete_image('image/front/room/', $Room->poster_url);
            $extension = $file->getClientOriginalExtension();
            $poster_url = time() . '.' . $extension;
            $file->move('image/front/room/', $poster_url);
            $Room = array(
                'name' => $request->name,
                'description' => $request->description,
                'floor_area' => $request->floor_area,
                'type' => $request->type,
                'price' => $request->price,
                'hotel_id' => $request->hotel_id,
                'poster_url' => $poster_url
            );

            if ($request->has('facilities')) {
                $room->facilities()->sync($request->facilities);
            }
            Room::findOrfail($room->id)->update($Room);

        }
        $Room = Room::find($room->id);
        $Room->name = $request->get('name');
        $Room->description = $request->get('description');
        $Room->floor_area = $request->get('floor_area');
        $Room->type = $request->get('type');
        $Room->price = $request->get('price');
        $Room->hotel_id = $request->get('hotel_id');
        if ($file)
            $Room->poster_url = $poster_url;
        $Room->update();

        if ($request->has('facilities')) {
            $room->facilities()->sync($request->facilities);
        }
        return to_route('rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room): RedirectResponse
    {
        $this->authorize('delete', $room);
        $this->delete_image('image/front/room/', $room->poster_url);
        $room->facilities()->detach();
        $room->delete();
        return back()->with('danger', 'Room deleted successfully.');
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
