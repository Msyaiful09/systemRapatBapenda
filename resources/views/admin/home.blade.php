@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">

        <div style="min-height: 100vh;" class="col-md-2 bg-success text-white vh-100">
            <div style="min-height: 100vh" class="d-flex flex-column justify-content-between p-3 text-center">
                <div>
                    <img src="https://4.bp.blogspot.com/-aede0SeUcks/ToCcc4GgMHI/AAAAAAAAALs/ciEVOzdgfTM/s1600/Logo+Kota+Pontianak.png" alt="Logo BAPENDA" class="img-fluid mb-3" style="max-width: 100px;">
                    <h4>BAPENDA </h4>
                    <h4>Kota Pontianak</h4>
                </div>
                <div class="nav flex-column mt-4" style="min-height: 60vh">
                    <li class="nav-item">
                        <a class="nav-link text-white" onclick="displayAll()" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" onclick="displayRuangan()" href="#">Ruangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" onclick="displayBooking()" href="#">Jadwal Rapat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" onclick="displayKaryawan()" href="#">Karyawan</a>
                    </li>
                </div>
                <div>
                    <a class="dropdown-item"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <span class="fas fa-sign-out-alt me-2"></span>{{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-10 my-auto bg-white" style="height: 90vh; overflow-y: scroll;">
            <div class="container">
                <h3 class="text-center">Dashboard Admin</h3>
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div id="ruangan" class="card mt-4">
                    <div class="card-header bg-success text-white">Daftar Ruangan</div>
                        <div class="card-body">
                            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#ruangan">Tambah Ruangan Baru</button>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center">No</th>
                                        <th class="align-middle text-center">Nama Ruangan</th>
                                        <th class="align-middle text-center">Lokasi Ruangan</th>
                                        <th class="align-middle text-center">Kapasitas</th>
                                        <th class="align-middle text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data['ruangan'] as $item)
                                        <tr>
                                            <td class="align-middle text-center">{{$no++}}</td>
                                            <td class="align-middle text-center">{{$item->name}}</td>
                                            <td class="align-middle text-center">{{$item->location}}</td>
                                            <td class="align-middle text-center">{{$item->capacity}}</td>
                                            <td class="align-middle text-center">Coming Soon.</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>

                <div id="booking" class="card mt-4">
                    <div class="card-header bg-success text-white">
                        Jadwal Rapat
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#bookingRuangan">Ajukan Jadwal Rapat</button>
                        <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="align-middle text-center">No</th>
                                            <th class="align-middle text-center">Nama Ruangan</th>
                                            <th class="align-middle text-center">Lokasi Ruangan</th>
                                            <th class="align-middle text-center">Hari/Tanggal</th>
                                            <th class="align-middle text-center">Jam Mulai</th>
                                            <th class="align-middle text-center">Jam Selesai</th>
                                            <th class="align-middle text-center">Diajukan Oleh</th>
                                            <th class="align-middle text-center">Status</th>
                                            <th class="align-middle text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $noo = 1;
                                        @endphp
                                        @foreach ($data['booking'] as $item)
                                        <tr>
                                            <td class="align-middle text-center">{{$noo++}}</td>
                                            <td class="align-middle text-center">{{$item->ruangan->name}}</td>
                                            <td class="align-middle text-center">{{$item->ruangan->location}}</td>
                                            <td class="align-middle text-center">{{Carbon\Carbon::parse($item->booking_date)->locale('id')->isoFormat('dddd, D MMMM YYYY')}}</td>
                                            <td class="align-middle text-center">{{$item->start_time}}</td>
                                            <td class="align-middle text-center">{{$item->end_time}}</td>
                                            <td class="align-middle text-center">{{$item->oleh->name}}</td>
                                            <td class="align-middle text-center">
                                                @if ($item->status == 'pending')
                                                    Menunggu Konfirmasi
                                                @elseif ($item->status == 'confirmed')
                                                    @if(Carbon\Carbon::now() > $item->booking_date && Carbon\Carbon::now()->format('H:i:s') > $item->end_time)
                                                        Selesai
                                                    @elseif(Carbon\Carbon::now() > $item->booking_date && Carbon\Carbon::now()->format('H:i:s') > $item->start_time && Carbon\Carbon::now()->format('H:i:s') < $item->end_time)
                                                        Sedang Digunakan
                                                    @else
                                                        Menunggu
                                                    @endif
                                                @elseif ($item->status == 'rejected')
                                                    Ditolak
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-center gap-2">
                                                @if ($item->status == 'pending')
                                                    <form method="POST" action="{{route('konfirmasiBooking', $item->id)}}" id="form-konfirmasi-{{$item->id}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <a onclick="confirmKonfirmasi({{$item->id}})" class="btn btn-success">Konfirmasi</a>
                                                    </form>
                                                    <form method="POST" action="{{route('tolakBooking', $item->id)}}" id="form-tolak-{{$item->id}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <a onclick="confirmTolak({{$item->id}})" class="btn btn-warning">Tolak</a>
                                                    </form>
                                                @endif
                                                @if ($item->status == 'confirmed' || $item->status == 'rejected')
                                                    <form method="POST" action="{{route('bookings.destroy', $item->id)}}" id="form-hapus-{{$item->id}}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a onclick="confirmHapus({{$item->id}})" class="btn btn-danger">Hapus</a>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                    </div>
                </div>

                <div id="karyawan" class="card mt-4">
                        <div class="card-header bg-success text-white">List Karyawan</div>
                            <div class="card-body">
                                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#bookingRuangan">Tambah Akun Karyawan</button>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="align-middle text-center">No</th>
                                            <th class="align-middle text-center">NIP</th>
                                            <th class="align-middle text-center">Nama Karyawan</th>
                                            <th class="align-middle text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $nooo = 1;
                                        @endphp
                                        @foreach ($data['karyawan'] as $item)
                                        <tr>
                                            <td class="align-middle text-center">{{$nooo++}}</td>
                                            <td class="align-middle text-center">{{$item->nip}}</td>
                                            <td class="align-middle text-center">{{$item->name}}</td>
                                            <td class="align-middle text-center">Coming Soon.</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="ruangan" tabindex="-1" aria-labelledby="tambahRuanganModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="tambahJadwalModalLabel">Tambah Data Ruangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form method="POST" action="{{ route('rooms.store') }}" id="tambah-ruangan-form" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="namaRuangan" class="form-label">Nama Ruangan</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Lokasi Ruangan</label>
                        <input type="text" class="form-control" name="location" id="location" required>
                    </div>
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Kapasitas</label>
                        <input type="number" class="form-control" name="capacity" id="capacity" required>
                    </div>
                </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" onclick="confirmTambahRuangan()">Tambah Ruangan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bookingRuangan" tabindex="-1" aria-labelledby="tambahJadwalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="tambahJadwalModalLabel">Ajukan Booking Ruangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form method="POST" action="{{ route('bookings.store') }}" id="ajukan-form" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                    <label for="namaRuangan" class="form-label">Pilih Ruangan</label>
                    <select class="form-select" name="idRuangan" id="namaRuangan" required>
                        <option value="" hidden></option>
                        @foreach ($data['ruangan'] as $item)
                        <option value="{{$item->id}}">{{$item->name}} | {{$item->location}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                    </div>
                    <div class="mb-3">
                    <label for="waktuMulai" class="form-label">Waktu Mulai</label>
                    <input type="time" class="form-control" name="waktu_mulai" id="waktuMulai" required>
                    </div>
                    <div class="mb-3">
                    <label for="waktuSelesai" class="form-label">Waktu Selesai</label>
                    <input type="time" class="form-control" name="waktu_selesai" id="waktuSelesai" required>
                    </div>
                </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" onclick="confirmAjukan()">Ajukan</button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('script')
    <script>
        function confirmKonfirmasi(id) {
            Swal.fire({
                title: 'Apakah anda yakin ingin mengkonfirmasi pengajuan?',
                text: "pengajuan yang sudah dikonfirmasi tidak bisa dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-konfirmasi-' + id).submit();
                }
            });
        }
        function confirmTolak(id) {
            Swal.fire({
                title: 'Apakah anda yakin ingin menolak pengajuan?',
                text: "pengajuan yang sudah ditolak tidak bisa dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-tolak-' + id).submit();
                }
            });
        }
        function confirmHapus(id) {
            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus pengajuan?',
                text: "pengajuan yang sudah dihapus tidak bisa dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-hapus-' + id).submit();
                }
            });
        }
        function confirmAjukan() {
            Swal.fire({
                title: 'Apakah anda yakin ingin menambah data?',
                text: "Data yang ditambah statusnya langsung terkonfirmasi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('ajukan-form').submit();
                }
            });
        }
        function confirmTambahRuangan() {
            Swal.fire({
                title: 'Apakah anda yakin ingin menambah ruangan?',
                text: "ruangan akan ditambahkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('tambah-ruangan-form').submit();
                }
            });
        }
        function displayAll() {
            document.getElementById('ruangan').classList.remove('hidden');
            document.getElementById('booking').classList.remove('hidden');
            document.getElementById('karyawan').classList.remove('hidden');
        }
        function displayRuangan() {
            document.getElementById('ruangan').classList.remove('hidden');
            document.getElementById('booking').classList.add('hidden');
            document.getElementById('karyawan').classList.add('hidden');
        }
        function displayBooking() {
            document.getElementById('ruangan').classList.add('hidden');
            document.getElementById('booking').classList.remove('hidden');
            document.getElementById('karyawan').classList.add('hidden');
        }
        function displayKaryawan() {
            document.getElementById('ruangan').classList.add('hidden');
            document.getElementById('booking').classList.add('hidden');
            document.getElementById('karyawan').classList.remove('hidden');
        }
    </script>
@endsection
