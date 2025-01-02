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
                        <a class="nav-link text-white" href="/rooms">Ruangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/jadwal">Jadwal Rapat</a>
                        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Karyawan</a>
                        
                    </li>
                   
                </ul>
            </div>
        </div>
        <div class="col-md-10">
            <div class="container mt-4">
                <h3 class="text-center">Dashboard Admin</h3>
                <div class="card mt-4">
                    <div class="card-header bg-success text-white">Antrean Ruangan</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Ruangan</th>
                                    <th>Status</th>
                                    <th>Waktu Pemakaian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Ruang Rapat Besar</td>
                                    <td>Terpakai</td>
                                    <td>09:00 - 11:00</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Ruang Rapat Kecil</td>
                                    <td>Tersedia</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="card mt-4">
                    <div class="card-header bg-success text-white">Jadwal Rapat</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Hari/Tanggal</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Acara</th>
                                <th>Tempat</th>
                                <th>Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Senin, 12 Desember 2024</td>
                                <td>09:00</td>
                                <td>12:00</td>
                                <td>Rapat Koordinasi</td>
                                <td>Ruang Rapat Kecil</td>
                                <td>Pembahasan program 2025</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Selasa, 13 Desember 2024</td>
                                <td>07:00</td>
                                <td>12:00</td>
                                <td>undangan pemet peningkatan kapentas dan kapasilitas tentang management </td>
                                <td>Hotel jogjakarta  </td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
