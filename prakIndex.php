
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin Praktikum</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            padding-top: 20px;
            background: #2c3e50;
            color: white;
            width: 250px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar h4 {
            color: black;
            padding: 15px;
            margin-bottom: 20px;
            border-bottom: 1px solid #34495e;
        }

        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 12px 20px;
            margin: 8px 16px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #34495e;
            color: #fff;
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            background-color: #3498db;
            color: white;
        }

        .content {
            margin-left: 250px;
            padding: 20px 40px;
        }

        .table-section {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .table-section h2 {
            color: #2c3e50;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
        }

        .table {
            border-radius: 5px;
            overflow: hidden;
        }

        .table thead {
            background-color: #3498db;
            color: white;
        }

        .table thead th {
            border: none;
            padding: 15px;
            font-weight: 500;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        .btn {
            border-radius: 5px;
            padding: 8px 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #3498db;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .btn-info {
            background-color: #2ecc71;
            border: none;
        }

        .btn-info:hover {
            background-color: #27ae60;
        }

        .btn-danger {
            background-color: #e74c3c;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        th {
        cursor: pointer;
        position: relative;
        padding-right: 20px !important;
        }

        th:not(.no-sort):after,
        th:not(.no-sort):before {
            content: '';
            position: absolute;
            right: 3px;
            opacity: 0.4;
        }

        /* Panah atas */
        th:not(.no-sort):before {
            bottom: 50%;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-bottom: 5px solid #333;
        }

        /* Panah bawah */
        th:not(.no-sort):after {
            top: 50%;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid #333;
        }

        th.sort-asc:before {
            opacity: 1;
        }

        th.sort-desc:after {
            opacity: 1;
        }

        th.no-sort {
            pointer-events: none;
        }

        .dashboard-section {
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }

    .card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }

    .card-title {
        color: #2c3e50;
        font-weight: 600;
    }

    .card-text {
        font-size: 24px;
        font-weight: 700;
        color: #3498db;
    }
    </style>
</head>
<body>
<?php
// Tambahkan ini di bagian atas file
include 'koneksi.php';

// Fungsi untuk menghitung jumlah data dari tabel
function getCount($tableName) {
    global $koneksi;
    try {
        $result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM $tableName");
        if ($result) {
            $data = mysqli_fetch_assoc($result);
            return $data['total'];
        }
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
    return "N/A";
}
?>
    <div class="sidebar bg-light">
        <h4 class="text-center">Menu Admin</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#" onclick="showSection('dashboard')"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#" onclick="showTable('asisten')"><i class="fas fa-users mr-2"></i>Asisten</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#" onclick="showTable('jadwal')"><i class="fas fa-calendar-alt mr-2"></i>Jadwal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#" onclick="showTable('mata_kuliah')"><i class="fas fa-book mr-2"></i>Mata Kuliah</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#" onclick="showTable('peserta')"> <i class="fas fa-user-graduate mr-2"></i>Peserta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#" onclick="showTable('praktikum')"><i class="fas fa-flask mr-2"></i>Praktikum</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#" onclick="showTable('ruang')"><i class="fas fa-door-open mr-2"></i>Ruang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#" onclick="showTable('peserta_praktikum')"><i class="fas fa-user-plus mr-2"></i>Peserta Praktikum</a>
            </li>
        </ul>
    </div>

    <div class="content">
        <div class="container mt-5">
            <h1 class="text-center">Halaman Admin Praktikum</h1>
            <div id="dashboard" class="dashboard-section">
            <h2 class="mt-4 mb-4">Dashboard</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Asisten</h5>
                            <p class="card-text">Jumlah: <?php echo getCount('asisten'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Jadwal</h5>
                            <p class="card-text">Jumlah: <?php echo getCount('jadwal'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Mata Kuliah</h5>
                            <p class="card-text">Jumlah: <?php echo getCount('mata_kuliah'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Peserta</h5>
                            <p class="card-text">Jumlah: <?php echo getCount('peserta'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Praktikum</h5>
                            <p class="card-text">Jumlah: <?php echo getCount('praktikum'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ruang</h5>
                            <p class="card-text">Jumlah: <?php echo getCount('ruang'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Peserta Praktikum</h5>
                            <p class="card-text">Jumlah: <?php echo getCount('peserta_praktikum'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
            <div id="asisten" class="table-section">
                <h2 class="mt-4">Data Asisten</h2>
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahAsistenModal">Tambah Asisten</button>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th class="sort-column" onclick="sortTable(0, this)">No</th>
                        <th class="sort-column" onclick="sortTable(1, this)">ID Asisten</th>
                        <th class="sort-column" onclick="sortTable(2, this)">Nama Asisten</th>
                        <th class="sort-column" onclick="sortTable(3, this)">No Telepon</th>
                        <th class="no-sort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        include 'koneksi.php';
                        $no = 1;
                        $data = mysqli_query($koneksi,"SELECT * FROM asisten");
                        while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['id_asisten']; ?></td>
                            <td><?php echo $d['nama_asisten']; ?></td>
                            <td><?php echo $d['no_tlp']; ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ubahAsistenModal<?php echo $d['id_asisten']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a role="button" class="btn btn-sm btn-danger" href="hapusAsisten.php?id=<?php echo $d['id_asisten']; ?>" onclick="return confirm('Yakin hapus data?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="jadwal" class="table-section" style="display:none;">
                <h2 class="mt-4">Data Jadwal</h2>
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahJadwalModal">Tambah Jadwal</button>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th class="sort-column" onclick="sortTable(0, this)">No</th>
                        <th class="sort-column" onclick="sortTable(1, this)">ID Jadwal</th>
                        <th class="sort-column" onclick="sortTable(2, this)">ID Praktikum</th>
                        <th class="sort-column" onclick="sortTable(3, this)">ID Ruang</th>
                        <th class="sort-column" onclick="sortTable(4, this)">Hari</th>
                        <th class="sort-column" onclick="sortTable(5, this)">Jam Mulai</th>
                        <th class="sort-column" onclick="sortTable(6, this)">Jam Selesai</th>
                        <th class="no-sort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        include 'koneksi.php';
                        $no = 1;
                        $data = mysqli_query($koneksi,"SELECT * FROM jadwal");
                        while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['id_jadwal']; ?></td>
                            <td><?php echo $d['id_praktikum']; ?></td>
                            <td><?php echo $d['id_ruang']; ?></td>
                            <td><?php echo $d['hari']; ?></td>
                            <td><?php echo $d['jam_mulai']; ?></td>
                            <td><?php echo $d['jam_selesai']; ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ubahJadwalModal<?php echo $d['id_jadwal']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a role="button" class="btn btn-sm btn-danger" href="hapusJadwal.php?id=<?php echo $d['id_jadwal']; ?>" onclick="return confirm('Yakin hapus data?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Tabel Mata Kuliah -->
            <div id="mata_kuliah" class="table-section" style="display:none;">
                <h2 class="mt-4">Data Mata Kuliah</h2>
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahMataKuliahModal">Tambah Mata Kuliah</button>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th class="sort-column" onclick="sortTable(0, this)">No</th>
                        <th class="sort-column" onclick="sortTable(1, this)">Kode MK</th>
                        <th class="sort-column" onclick="sortTable(2, this)">Nama MK</th>
                        <th class="sort-column" onclick="sortTable(3, this)">SKS</th>
                        <th class="no-sort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        include 'koneksi.php';
                        $no = 1;
                        $data = mysqli_query($koneksi,"SELECT * FROM mata_kuliah");
                        while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['kode_mk']; ?></td>
                            <td><?php echo $d['nama_mk']; ?></td>
                            <td><?php echo $d['sks']; ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ubahMataKuliahModal<?php echo $d['kode_mk']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a role="button" class="btn btn-sm btn-danger" href="hapusMatkul.php?id=<?php echo $d['kode_mk']; ?>" onclick="return confirm('Yakin hapus data?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Tabel Peserta -->
            <div id="peserta" class="table-section" style="display:none;">
                <h2 class="mt-4">Data Peserta</h2>
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahPesertaModal">Tambah Peserta</button>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <<th class="sort-column" onclick="sortTable(0, this)">No</th>
                        <th class="sort-column" onclick="sortTable(1, this)">NIM</th>
                        <th class="sort-column" onclick="sortTable(2, this)">Nama Mahasiswa</th>
                        <th class="sort-column" onclick="sortTable(3, this)">Jurusan</th>
                        <th class="sort-column" onclick="sortTable(4, this)">Email</th>
                        <th class="no-sort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        include 'koneksi.php';
                        $no = 1;
                        $data = mysqli_query($koneksi,"SELECT * FROM peserta");
                        while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['nim']; ?></td>
                            <td><?php echo $d['nama_mhs']; ?></td>
                            <td><?php echo $d['jurusan']; ?></td>
                            <td><?php echo $d['email']; ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ubahPesertaModal<?php echo $d['nim']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a role="button" class="btn btn-sm btn-danger" href="hapusPeserta.php?id=<?php echo $d['nim']; ?>" onclick="return confirm('Yakin hapus data?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Tabel Praktikum -->
            <div id="praktikum" class="table-section" style="display:none;">
                <h2 class="mt-4">Data Praktikum</h2>
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahPraktikumModal">Tambah Praktikum</button>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th class="sort-column" onclick="sortTable(0, this)">No</th>
                        <th class="sort-column" onclick="sortTable(1, this)">ID Praktikum</th>
                        <th class="sort-column" onclick="sortTable(2, this)">ID Asisten</th>
                        <th class="sort-column" onclick="sortTable(3, this)">Kode MK</th>
                        <th class="sort-column" onclick="sortTable(4, this)">Nama Praktikum</th>
                        <th class="no-sort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        include 'koneksi.php';
                        $no = 1;
                        $data = mysqli_query($koneksi,"SELECT * FROM praktikum");
                        while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['id_praktikum']; ?></td>
                            <td><?php echo $d['id_asisten']; ?></td>
                            <td><?php echo $d['kode_mk']; ?></td>
                            <td><?php echo $d['nama_praktikum']; ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ubahPraktikumModal<?php echo $d['id_praktikum']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a role="button" class="btn btn-sm btn-danger" href="hapusPraktikum.php?id=<?php echo $d['id_praktikum']; ?>" onclick="return confirm('Yakin hapus data?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Tabel Ruang -->
            <div id="ruang" class="table-section" style="display:none;">
                <h2 class="mt-4">Data Ruang</h2>
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahRuangModal">Tambah Ruang</button>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th class="sort-column" onclick="sortTable(0, this)">No</th>
                        <th class="sort-column" onclick="sortTable(1, this)">ID Ruang</th>
                        <th class="sort-column" onclick="sortTable(2, this)">Nama Ruang</th>
                        <th class="sort-column" onclick="sortTable(3, this)">Kapasitas</th>
                        <th class="no-sort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        include 'koneksi.php';
                        $no = 1;
                        $data = mysqli_query($koneksi,"SELECT * FROM ruang");
                        while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['id_ruang']; ?></td>
                            <td><?php echo $d['nama_ruang']; ?></td>
                            <td><?php echo $d['kapasitas']; ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ubahRuangModal<?php echo $d['id_ruang']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a role="button" class="btn btn-sm btn-danger" href="hapusRuang.php?id=<?php echo $d['id_ruang']; ?>" onclick="return confirm('Yakin hapus data?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="peserta_praktikum" class="table-section" style="display:none;">
                <h2 class="mt-4">Data Peserta Praktikum</h2>
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahPesertaPraktikumModal">Tambah Peserta Praktikum</button>
                <table class="table table-bordered">
                <thead>
                    <tr>
                    <th class="sort-column" onclick="sortTable(0, this)">ID Peserta Praktikum</th>
                    <th class="sort-column" onclick="sortTable(1, this)">NIM</th>
                    <th class="sort-column" onclick="sortTable(2, this)">Nama Mahasiswa</th>
                    <th class="sort-column" onclick="sortTable(3, this)">ID Praktikum</th>
                    <th class="sort-column" onclick="sortTable(4, this)">Nama Praktikum</th>
                    <th class="sort-column" onclick="sortTable(5, this)">Tanggal Daftar</th>
                    <th class="no-sort">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $data = mysqli_query($koneksi, "SELECT pp.id_peserta_praktikum, pp.nim, p.nama_mhs, pp.id_praktikum, pr.nama_praktikum, pp.tgl_daftar 
                                                    FROM peserta_praktikum pp
                                                    JOIN peserta p ON pp.nim = p.nim
                                                    JOIN praktikum pr ON pp.id_praktikum = pr.id_praktikum");
                    while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                        <td><?php echo $d['id_peserta_praktikum']; ?></td>
                        <td><?php echo $d['nim']; ?></td>
                        <td><?php echo $d['nama_mhs']; ?></td>
                        <td><?php echo $d['id_praktikum']; ?></td>
                        <td><?php echo $d['nama_praktikum']; ?></td>
                        <td><?php echo $d['tgl_daftar']; ?></td>
                        <td>
                            <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#ubahPesertaPraktikumModal<?php echo $d['id_peserta_praktikum']; ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a class="btn btn-sm btn-danger" href="hapusPesertaPraktikum.php?id=<?php echo $d['id_peserta_praktikum']; ?>" onclick="return confirm('Yakin hapus data?');">
                                <i class="fas fa-trash"></i>
                            </a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                </table>
            </div>
            <!-- Tambahkan div serupa untuk tabel lainnya (jadwal, mata_kuliah, peserta, praktikum, ruang) -->

        </div>
    </div>
    
    <?php include 'modalTambah.php'; ?>
    <?php include 'modalUbah.php'; ?>

    <script>
        function showSection(sectionId) {
        const sections = document.querySelectorAll('.table-section, .dashboard-section');
        sections.forEach(section => {
            section.style.display = 'none';
        });
        document.getElementById(sectionId).style.display = 'block';
    }

    function showTable(tableId) {
        showSection(tableId);
    }

    // Show dashboard by default
    window.onload = function() {
        showSection('dashboard');
    }

    // Fungsi untuk menampilkan tabel yang aktif
function showActiveTable() {
    // Ambil parameter activeTable dari URL
    const urlParams = new URLSearchParams(window.location.search);
    const activeTable = urlParams.get('activeTable');
    
    // Jika ada parameter activeTable, tampilkan tabel tersebut
    if (activeTable) {
        showSection(activeTable);
    } else {
        // Default ke dashboard
        showSection('dashboard');
    }
}

// Panggil fungsi showActiveTable saat halaman dimuat
window.onload = showActiveTable;

function sortTable(columnIndex, headerElement) {
    const table = headerElement.closest('table');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    
    // Reset sort state untuk semua header
    table.querySelectorAll('th').forEach(th => {
        if (th !== headerElement) {
            th.classList.remove('sort-asc', 'sort-desc');
        }
    });
    
    // Toggle sort order
    const isAscending = !headerElement.classList.contains('sort-asc');
    headerElement.classList.remove('sort-asc', 'sort-desc');
    headerElement.classList.add(isAscending ? 'sort-asc' : 'sort-desc');
    
    // Sort rows
    rows.sort((a, b) => {
        const aValue = a.children[columnIndex].textContent.trim();
        const bValue = b.children[columnIndex].textContent.trim();
        
        // Check if values are numbers
        const aNum = parseFloat(aValue);
        const bNum = parseFloat(bValue);
        
        if (!isNaN(aNum) && !isNaN(bNum)) {
            return isAscending ? aNum - bNum : bNum - aNum;
        }
        
        // Sort as strings
        return isAscending ? 
            aValue.localeCompare(bValue) : 
            bValue.localeCompare(aValue);
    });
    
    // Reattach sorted rows
    rows.forEach(row => tbody.appendChild(row));
}
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>