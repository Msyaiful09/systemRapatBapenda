<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Karyawan - BAPENDA Kota Pontianak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #005f4b;
            color: white;
            position: fixed;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .sidebar .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar .nav-item {
            margin: 10px 0;
        }

        .sidebar .nav-item a {
            text-decoration: none;
            color: white;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-item a:hover {
            text-decoration: underline;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            left: 250px;
            width: calc(100% - 250px);
            font-size: 0.85rem;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        table, th, td {
            border: 2px solid #005f4b;
        }

        .form-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="https://4.bp.blogspot.com/-aede0SeUcks/ToCcc4GgMHI/AAAAAAAAALs/ciEVOzdgfTM/s1600/Logo+Kota+Pontianak.png" alt="Logo" width="80">
            <h4>BAPENDA Kota Pontianak</h4>
        </div>
        <div class="nav-item">
            <a href="#" id="beranda"><i class="fas fa-home me-2"></i> Beranda</a>
        </div>
        <div class="nav-item">
            <a href="#"><i class="fas fa-door-open me-2"></i> Ruangan</a>
            <ul>
                <li><a href="#" id="lihat-ruangan" style="color: white;">Lihat Antrean Ruangan</a></li>
            </ul>
        </div>
        <div class="nav-item">
            <a href="#"><i class="fas fa-calendar-check me-2"></i> Jadwal Rapat</a>
            <ul>
                <li><a href="#" id="lihat-jadwal-ruangan" style="color: white;">Lihat Jadwal Rapat</a></li>
            </ul>
        </div>
        <div class="nav-item">
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <span class="fas fa-sign-out-alt me-2"></span>{{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
    <div class="main-content d-flex flex-column gap-4" id="main-content">
        {{-- <div class="header">
            <h1>Dashboard Karyawan</h1>
        </div> --}}

        <div class="card" id="beranda-section">
            <h3>Selamat Datang, {{Auth::user()->name}}</h3>
            <p>Di sini Anda dapat melihat jadwal rapat dan mengajukan booking.</p>
        </div>

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

        <div class="card" id="ruangan-section" style="display:none;">
            <h3>Daftar Ruangan</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ruangan</th>
                        <th>Lokasi</th>
                        <th>Kapasitas</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data['ruangan'] as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->location}}</td>
                            <td>{{$item->capacity}}</td>
                            <td>Coming Soon.</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card" id="jadwal-ruangan-section" style="display:none;">
            <h3>Jadwal Rapat Ruangan</h3>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#bookingRuangan">Ajukan Booking Ruangan</button>
            <table class="table" id="jadwalTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ruangan</th>
                        <th>Lokasi Ruangan</th>
                        <th>Tanggal</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $noo = 1;
                    @endphp
                    @foreach ($data['booking'] as $item)
                        <tr>
                            <td>{{$noo++}}</td>
                            <td>{{$item->ruangan->name}}</td>
                            <td>{{$item->ruangan->location}}</td>
                            <td>{{$item->booking_date}}</td>
                            <td>{{$item->start_time}}</td>
                            <td>{{$item->end_time}}</td>
                            <td>
                                @if ($item->status == 'pending')
                                    Menunggu Konfirmasi
                                @elseif ($item->status == 'confirmed')
                                    @if(Carbon\Carbon::now()->format('H:i:s') > $item->end_time)
                                        Selesai
                                    @elseif(Carbon\Carbon::now()->format('H:i:s') > $item->start_time && Carbon\Carbon::now()->format('H:i:s') < $item->end_time)
                                        Sedang Digunakan
                                    @else
                                        Menunggu
                                    @endif
                                @elseif ($item->status == 'rejected')
                                    Ditolak
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <footer>
        <p>&copy; 2024 BAPENDA Kota Pontianak. All Rights Reserved.</p>
    </footer>
    <script>
    $(document).ready(function () {
        $('#jadwalTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.5/i18n/Indonesian.json" // For Indonesian translations
            },
            "order": [[0, "asc"]] // Sort by the first column (No) ascending
        });
    });
</script>


    {{-- modal --}}
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmAjukan() {
            Swal.fire({
                title: 'Apakah anda yakin ingin mengajukan data?',
                text: "Data yang sudah diajukan tidak bisa diedit!",
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
        document.getElementById('ruangan-section').style.display = 'block';
        document.getElementById('jadwal-ruangan-section').style.display = 'block';
        document.getElementById('beranda').addEventListener('click', function() {
            document.getElementById('ruangan-section').style.display = 'block';
            // document.getElementById('beranda-section').style.display = 'none';
            document.getElementById('jadwal-ruangan-section').style.display = 'block';
            // document.getElementById('karyawan-section').style.display = 'none';
        });

        document.getElementById('lihat-ruangan').addEventListener('click', function() {
            document.getElementById('ruangan-section').style.display = 'block';
            // document.getElementById('beranda-section').style.display = 'none';
            document.getElementById('jadwal-ruangan-section').style.display = 'none';
            // document.getElementById('karyawan-section').style.display = 'none';
        });

        document.getElementById('lihat-jadwal-ruangan').addEventListener('click', function() {
            document.getElementById('jadwal-ruangan-section').style.display = 'block';
            // document.getElementById('beranda-section').style.display = 'none';
            document.getElementById('ruangan-section').style.display = 'none';
            // document.getElementById('karyawan-section').style.display = 'none';
        });
    </script>



</body>
</html>
