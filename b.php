<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin Praktikum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            padding-top: 20px;
        }
        .content {
            margin-left: 250px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <h4 class="text-center">Menu Admin</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showTable('asisten')">Asisten</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showTable('jadwal')">Jadwal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showTable('mata_kuliah')">Mata Kuliah</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showTable('peserta')">Peserta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showTable('praktikum')">Praktikum</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showTable('ruang')">Ruang</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Halaman Admin Praktikum</h1>
                </div>

                <div id="asisten" class="table-section">
                    <h2>Data Asisten</h2>
                    <button class="btn btn-primary mb-3" onclick="openModal('add', 'asisten')">Tambah Asisten</button>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Asisten</th>
                                <th>Nama Asisten</th>
                                <th>No Telepon</th>
                                <th>Aksi</th>
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
                                    <button class="btn btn-sm btn-warning" onclick="openModal('edit', '<?php echo $d['id_asisten']; ?>')">UBAH</button>
                                    <a class="btn btn-sm btn-danger" href="hapusAsisten?id=<?php echo $d['id_asisten']; ?>">HAPUS</a>
                                </td>
                            </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                            
                
                <div id="jadwal" class="table-section" style="display: none;">
                    <div class="card">
                        <div class="card-header">
                            <h2>Data Jadwal Praktikum</h2>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary mb-3" onclick="openModalJadwal('add')">
                                <i class="fas fa-plus"></i> Tambah Jadwal
                            </button>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>ID Jadwal</th>
                                            <th>Praktikum</th>
                                            <th>Ruang</th>
                                            <th>Asisten</th>
                                            <th>Hari</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        include 'koneksi.php';
                                        $no = 1;
                                        $query = "SELECT j.*, p.nama_praktikum, r.nama_ruang, a.nama_asisten 
                                                FROM jadwal j
                                                JOIN praktikum p ON j.id_praktikum = p.id_praktikum
                                                JOIN ruang r ON j.id_ruang = r.id_ruang
                                                JOIN asisten a ON j.id_asisten = a.id_asisten";
                                        $data = mysqli_query($koneksi, $query);
                                        while($d = mysqli_fetch_array($data)){
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $d['id_jadwal']; ?></td>
                                            <td><?php echo $d['nama_praktikum']; ?></td>
                                            <td><?php echo $d['nama_ruang']; ?></td>
                                            <td><?php echo $d['nama_asisten']; ?></td>
                                            <td><?php echo ucfirst($d['hari']); ?></td>
                                            <td><?php echo date('H:i', strtotime($d['jam_mulai'])); ?></td>
                                            <td><?php echo date('H:i', strtotime($d['jam_selesai'])); ?></td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" onclick="openModalJadwal('edit', '<?php echo $d['id_jadwal']; ?>')">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-danger btn-sm" onclick="deleteJadwal('<?php echo $d['id_jadwal']; ?>')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                        <?php 
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 
                
                <div id="mata_kuliah" class="table-section" style="display: none;">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h2 class="card-title mb-0">Data Mata Kuliah</h2>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-success mb-3" onclick="openModalMataKuliah('add')">
                                <i class="fas fa-plus"></i> Tambah Mata Kuliah
                            </button>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Kode MK</th>
                                            <th>Nama Mata Kuliah</th>
                                            <th>SKS</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        include 'koneksi.php';
                                        $no = 1;
                                        $query = "SELECT * FROM mata_kuliah ORDER BY kode_mk";
                                        $data = mysqli_query($koneksi, $query);
                                        while($d = mysqli_fetch_array($data)){
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $d['kode_mk']; ?></td>
                                            <td><?php echo $d['nama_mk']; ?></td>
                                            <td><?php echo $d['sks']; ?></td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button class="btn btn-warning btn-sm" onclick="openModalMataKuliah('edit', '<?php echo $d['kode_mk']; ?>')">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" onclick="deleteMataKuliah('<?php echo $d['kode_mk']; ?>')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php 
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="peserta" class="table-section" style="display: none;">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h2 class="card-title mb-0">Data Peserta Praktikum</h2>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-success mb-3" onclick="openModalPeserta('add')">
                                <i class="fas fa-plus"></i> Tambah Peserta
                            </button>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Jurusan</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        include 'koneksi.php';
                                        $no = 1;
                                        $query = "SELECT * FROM peserta ORDER BY nim";
                                        $data = mysqli_query($koneksi, $query);
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
                                                    <button class="btn btn-warning btn-sm" onclick="openModalPeserta('edit', '<?php echo $d['nim']; ?>')">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" onclick="deletePeserta('<?php echo $d['nim']; ?>')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php 
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="praktikum" class="table-section" style="display: none;">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h2 class="card-title mb-0">Data Praktikum</h2>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-success mb-3" onclick="openModalPraktikum('add')">
                                <i class="fas fa-plus"></i> Tambah Praktikum
                            </button>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>ID Praktikum</th>
                                            <th>Nama Praktikum</th>
                                            <th>Asisten</th>
                                            <th>Mata Kuliah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        include 'koneksi.php';
                                        $no = 1;
                                        $query = "SELECT p.*, a.nama_asisten, m.nama_mk 
                                                FROM praktikum p 
                                                JOIN asisten a ON p.id_asisten = a.id_asisten 
                                                JOIN mata_kuliah m ON p.kode_mk = m.kode_mk 
                                                ORDER BY p.id_praktikum";
                                        $data = mysqli_query($koneksi, $query);
                                        while($d = mysqli_fetch_array($data)){
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $d['id_praktikum']; ?></td>
                                            <td><?php echo $d['nama_praktikum']; ?></td>
                                            <td><?php echo $d['nama_asisten']; ?></td>
                                            <td><?php echo $d['nama_mk']; ?></td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button class="btn btn-warning btn-sm" onclick="openModalPraktikum('edit', '<?php echo $d['id_praktikum']; ?>')">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" onclick="deletePraktikum('<?php echo $d['id_praktikum']; ?>')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php 
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="ruang" class="table-section" style="display: none;">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h2 class="card-title mb-0">Data Ruang Praktikum</h2>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-success mb-3" onclick="openModalRuang('add')">
                                <i class="fas fa-plus"></i> Tambah Ruang
                            </button>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>ID Ruang</th>
                                            <th>Nama Ruang</th>
                                            <th>Kapasitas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        include 'koneksi.php';
                                        $no = 1;
                                        $query = "SELECT * FROM ruang ORDER BY id_ruang";
                                        $data = mysqli_query($koneksi, $query);
                                        while($d = mysqli_fetch_array($data)){
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $d['id_ruang']; ?></td>
                                            <td><?php echo $d['nama_ruang']; ?></td>
                                            <td><?php echo $d['kapasitas']; ?></td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button class="btn btn-warning btn-sm" onclick="openModalRuang('edit', '<?php echo $d['id_ruang']; ?>')">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" onclick="deleteRuang('<?php echo $d['id_ruang']; ?>')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php 
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Similar structure for other tables (jadwal, mata_kuliah, peserta, praktikum, ruang) -->
                <!-- Remember to adjust the table headers and data according to the SQL structure -->
            </main>
        </div>
    </div>

    <!-- Modal for Asisten -->
    <div class="modal fade" id="modalAsisten" tabindex="-1" aria-labelledby="modalTitleAsisten" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleAsisten">Tambah Asisten</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAsisten">
                        <input type="hidden" id="mode" name="mode" value="add">
                        <div class="mb-3">
                            <input type="text" id="id_asisten" name="id_asisten" class="form-control" placeholder="ID Asisten">
                        </div>
                        <div class="mb-3">
                            <input type="text" id="nama_asisten" name="nama_asisten" class="form-control" placeholder="Nama Asisten">
                        </div>
                        <div class="mb-3">
                            <input type="text" id="no_tlp" name="no_tlp" class="form-control" placeholder="No Telepon">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm('Asisten')">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    

    <div class="modal fade" id="modalJadwal" tabindex="-1" aria-labelledby="modalJadwalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalJadwalLabel">Tambah Jadwal Praktikum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formJadwal" method="POST">
                    <div class="modal-body">
                        <input type="hidden" id="mode" name="mode" value="add">
                        <input type="hidden" id="id_jadwal" name="id_jadwal">
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="id_praktikum" class="form-label">Praktikum</label>
                                <select class="form-select" id="id_praktikum" name="id_praktikum" required>
                                    <option value="">Pilih Praktikum</option>
                                    <?php
                                    $query = "SELECT * FROM praktikum";
                                    $result = mysqli_query($koneksi, $query);
                                    while($row = mysqli_fetch_array($result)) {
                                        echo "<option value='".$row['id_praktikum']."'>".$row['nama_praktikum']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="id_ruang" class="form-label">Ruang</label>
                                <select class="form-select" id="id_ruang" name="id_ruang" required>
                                    <option value="">Pilih Ruang</option>
                                    <?php
                                    $query = "SELECT * FROM ruang";
                                    $result = mysqli_query($koneksi, $query);
                                    while($row = mysqli_fetch_array($result)) {
                                        echo "<option value='".$row['id_ruang']."'>".$row['nama_ruang']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="id_asisten" class="form-label">Asisten</label>
                                <select class="form-select" id="id_asisten" name="id_asisten" required>
                                    <option value="">Pilih Asisten</option>
                                    <?php
                                    $query = "SELECT * FROM asisten";
                                    $result = mysqli_query($koneksi, $query);
                                    while($row = mysqli_fetch_array($result)) {
                                        echo "<option value='".$row['id_asisten']."'>".$row['nama_asisten']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="hari" class="form-label">Hari</label>
                                <select class="form-select" id="hari" name="hari" required>
                                    <option value="">Pilih Hari</option>
                                    <option value="senin">Senin</option>
                                    <option value="selasa">Selasa</option>
                                    <option value="rabu">Rabu</option>
                                    <option value="kamis">Kamis</option>
                                    <option value="jumat">Jumat</option>
                                    <option value="sabtu">Sabtu</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
                            </div>
                            <div class="col-md-6">
                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalMataKuliah" tabindex="-1" aria-labelledby="modalMataKuliahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalMataKuliahLabel">Tambah Mata Kuliah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formMataKuliah" method="POST">
                    <div class="modal-body">
                        <input type="hidden" id="mode" name="mode" value="add">
                        
                        <div class="mb-3">
                            <label for="kode_mk" class="form-label">Kode Mata Kuliah</label>
                            <input type="text" class="form-control" id="kode_mk" name="kode_mk" required 
                                pattern="[A-Za-z0-9]+" maxlength="10"
                                placeholder="Masukkan kode mata kuliah">
                            <div class="form-text">Gunakan huruf dan angka tanpa spasi</div>
                        </div>

                        <div class="mb-3">
                            <label for="nama_mk" class="form-label">Nama Mata Kuliah</label>
                            <input type="text" class="form-control" id="nama_mk" name="nama_mk" required
                                maxlength="50" placeholder="Masukkan nama mata kuliah">
                        </div>

                        <div class="mb-3">
                            <label for="sks" class="form-label">SKS</label>
                            <input type="number" class="form-control" id="sks" name="sks" required
                                min="1" max="6" placeholder="Jumlah SKS">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPeserta" tabindex="-1" aria-labelledby="modalPesertaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalPesertaLabel">Tambah Peserta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formPeserta" method="POST">
                    <div class="modal-body">
                        <input type="hidden" id="mode" name="mode" value="add">
                        
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim" required 
                                pattern="[0-9]+" maxlength="20"
                                placeholder="Masukkan NIM">
                            <div class="form-text">Masukkan NIM dengan angka</div>
                        </div>

                        <div class="mb-3">
                            <label for="nama_mhs" class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="nama_mhs" name="nama_mhs" required
                                maxlength="50" placeholder="Masukkan nama mahasiswa">
                        </div>

                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select class="form-select" id="jurusan" name="jurusan" required>
                                <option value="">Pilih Jurusan</option>
                                <option value="TI">Teknik Informatika</option>
                                <option value="SI">Sistem Informasi</option>
                                <option value="MI">Manajemen Informatika</option>
                                <option value="KA">Komputerisasi Akuntansi</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                maxlength="50" placeholder="Masukkan email">
                            <div class="form-text">Contoh: nama@domain.com</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPraktikum" tabindex="-1" aria-labelledby="modalPraktikumLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalPraktikumLabel">Tambah Praktikum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formPraktikum" method="POST">
                    <div class="modal-body">
                        <input type="hidden" id="mode" name="mode" value="add">
                        
                        <div class="mb-3">
                            <label for="id_praktikum" class="form-label">ID Praktikum</label>
                            <input type="text" class="form-control" id="id_praktikum" name="id_praktikum" required 
                                maxlength="10" placeholder="Masukkan ID Praktikum">
                        </div>

                        <div class="mb-3">
                            <label for="nama_praktikum" class="form-label">Nama Praktikum</label>
                            <input type="text" class="form-control" id="nama_praktikum" name="nama_praktikum" required
                                maxlength="50" placeholder="Masukkan nama praktikum">
                        </div>

                        <div class="mb-3">
                            <label for="id_asisten" class="form-label">Asisten</label>
                            <select class="form-select" id="id_asisten" name="id_asisten" required>
                                <option value="">Pilih Asisten</option>
                                <?php
                                $query_asisten = "SELECT * FROM asisten ORDER BY nama_asisten";
                                $asisten = mysqli_query($koneksi, $query_asisten);
                                while($a = mysqli_fetch_array($asisten)){
                                    echo "<option value='".$a['id_asisten']."'>".$a['nama_asisten']."</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="kode_mk" class="form-label">Mata Kuliah</label>
                            <select class="form-select" id="kode_mk" name="kode_mk" required>
                                <option value="">Pilih Mata Kuliah</option>
                                <?php
                                $query_mk = "SELECT * FROM mata_kuliah ORDER BY nama_mk";
                                $mk = mysqli_query($koneksi, $query_mk);
                                while($m = mysqli_fetch_array($mk)){
                                    echo "<option value='".$m['kode_mk']."'>".$m['nama_mk']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalRuang" tabindex="-1" aria-labelledby="modalRuangLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalRuangLabel">Tambah Ruang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formRuang" method="POST">
                    <div class="modal-body">
                        <input type="hidden" id="mode" name="mode" value="add">
                        
                        <div class="mb-3">
                            <label for="id_ruang" class="form-label">ID Ruang</label>
                            <input type="text" class="form-control" id="id_ruang" name="id_ruang" required 
                                maxlength="10" placeholder="Masukkan ID Ruang">
                            <div class="form-text">Contoh: LAB-01, R-101, dll</div>
                        </div>

                        <div class="mb-3">
                            <label for="nama_ruang" class="form-label">Nama Ruang</label>
                            <input type="text" class="form-control" id="nama_ruang" name="nama_ruang" required
                                maxlength="50" placeholder="Masukkan nama ruang">
                            <div class="form-text">Contoh: Laboratorium Komputer 1</div>
                        </div>

                        <div class="mb-3">
                            <label for="kapasitas" class="form-label">Kapasitas</label>
                            <input type="number" class="form-control" id="kapasitas" name="kapasitas" required
                                min="1" placeholder="Masukkan kapasitas ruang">
                            <div class="form-text">Jumlah maksimal mahasiswa yang dapat ditampung</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script src="next.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

    <!-- Similar modals for other tables -->
