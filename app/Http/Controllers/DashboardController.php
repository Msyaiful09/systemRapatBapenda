<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $data = [];
            $data['ruangan'] = Room::orderBy('id', 'desc')->get();
            $data['booking'] = Booking::all();
            $data['karyawan'] = User::all();
            return view('admin.home', compact('data'));
        } elseif (Auth::user()->role == 'karyawan') {
            $data = [];
            $data['ruangan'] = Room::all();
            $data['booking'] = Booking::all();
            return view('karyawan.dashboard', compact('data'));
        } else {
            return redirect()->route('login');
        }
    }
}
