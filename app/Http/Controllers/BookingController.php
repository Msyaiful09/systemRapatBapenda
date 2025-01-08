<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Booking::all();
        return view('admin.rapat.index', compact('data'));
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
    public function store(Request $request)
    {
        if ($request->tanggal < Carbon::now()->format('Y-m-d')) {
            return redirect()->back()->with('error', 'Ga Bisa Booking Masa Lalu');
        }
        $status = null;

        // Check for overlapping bookings
    $existingBooking = Booking::where('room_id', $request->idRuangan)
    ->where('booking_date', $request->tanggal)
    ->where('status','confirmed')
    ->where(function ($query) use ($request) {
        $query->whereBetween('start_time', [$request->waktu_mulai, $request->waktu_selesai])
              ->orWhereBetween('end_time', [$request->waktu_mulai, $request->waktu_selesai])
              ->orWhere(function ($subQuery) use ($request) {
                  $subQuery->where('start_time', '<=', $request->waktu_mulai)
                           ->where('end_time', '>=', $request->waktu_selesai);
              });
    })
    ->exists();

if ($existingBooking) {
    return redirect()->back()->with('error', 'Ruangan sudah dipesan pada waktu tersebut.');
}
        if(Auth::user()->role == 'admin') {
            $status = 'confirmed';
        } else {
            $status = 'pending';
        }
        Booking::create([
            'user_id' => Auth::user()->id,
            'room_id' => $request->idRuangan,
            'booking_date' => $request->tanggal,
            'start_time' => $request->waktu_mulai,
            'end_time' => $request->waktu_selesai,
            'status' => $status
        ]);

        return redirect()->back()->with('success', 'Booking Berhasil Diajukan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Booking::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil di Hapus!');
    }

    public function konfirmasiJadwal(String $id) {
        $data = Booking::findOrFail($id);
        if ($data) {
            $data->status = 'confirmed';
            $data->save();
            return redirect()->back()->with('success', 'Data berhasil di konfirmasi!');
        }
        return redirect()->back()->with('error', 'Data gagal di konfirmasi');
    }
    public function tolakJadwal(String $id) {
        $data = Booking::findOrFail($id);
        if ($data) {
            $data->status = 'rejected';
            $data->save();
            return redirect()->back()->with('success', 'Data berhasil di tolak');
        }
        return redirect()->back()->with('error', 'Data gagal di ubah');
    }
}
