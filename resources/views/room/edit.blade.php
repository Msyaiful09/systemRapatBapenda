@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 bg-success text-white vh-100">
            <div class="p-3 text-center">
                <img src="https://4.bp.blogspot.com/-aede0SeUcks/ToCcc4GgMHI/AAAAAAAAALs/ciEVOzdgfTM/s1600/Logo+Kota+Pontianak.png" alt="Logo BAPENDA" class="img-fluid mb-3" style="max-width: 100px;">
                <h4>BAPENDA </h4>
                <h4>Kota Pontianak</h4>
                <ul class="nav flex-column mt-4">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Ruangan</a>
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Lihat Antrean Ruangan</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Jadwal Rapat</a>
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Lihat Jadwal Rapat</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Karyawan</a>
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Lihat Karyawan</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-10">
            <div class="container mt-4">
                <h3 class="text-center">Dashboard Room</h3>
                <div class="card mt-4">
                    <div class="card-header bg-success text-white">Antrean Ruangan</div>
                    <div class="card-body">
                        <form action="{{ route('rooms.update', $data->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <label for="name">Nama Ruangan</label>
                          <input type="text" name="name" value="{{$data->name}}">
                          <label for="Location">Lokasi</label>
                          <input type="text" name="location" value="{{$data->location}}">
                          <label for="capacity">Kapasitas</label>
                          <input type="text" name="capacity" value="{{$data->capacity}}">
                          <button type="submit">Kirim</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection