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
                        <a href="/rooms/create">tambah</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Ruangan</th>
                                    <th>Lokasi</th>
                                    <th>Capacity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $dat)
                                    <tr>
                                        <td>{{$dat->id}}</td>
                                        <td>{{$dat->name}}</td>
                                        <td>{{$dat->location}}</td>
                                        <td>{{$dat->capacity}}</td>
                                        <td>
                                            <a href="{{ route('rooms.edit', $dat->id) }}">Edit</a>
                                            <form action="{{ route('rooms.destroy', $dat->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">DELETE</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
