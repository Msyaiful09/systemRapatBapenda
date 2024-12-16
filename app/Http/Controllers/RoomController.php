<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Room::all();
        return view('room.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('room.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required','string','max:255'],
            'location' => ['required','string','max:255'],
            'capacity' => ['required', 'integer'],
        ]);

        Room::create([
            'name' => $request->name,
            'location' => $request->location,
            'capacity' => $request->capacity,
        ]);
        
        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Room::find($id);
        return view('rooms.show', compact($data));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Room::find($id);
        return view('room.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => ['required','string','max:255'],
            'location' => ['required','string','max:255'],
            'capacity' => ['required', 'integer'],
        ]);

        $room = Room::where('id', $id)->first();
        $room->name = $request->name;
        $room->location = $request->location;
        $room->capacity = $request->capacity;
        $room->save();
        
        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Room::findOrFail($id);
        $data->delete();

        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }
}
