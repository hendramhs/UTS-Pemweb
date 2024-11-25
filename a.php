<!-- Modal Ubah Peserta Praktikum -->
<?php 
$data = mysqli_query($koneksi,"SELECT pp.*, p.nama_mhs, pr.nama_praktikum 
                                FROM peserta_praktikum pp
                                JOIN peserta p ON pp.nim = p.nim
                                JOIN praktikum pr ON pp.id_praktikum = pr.id_praktikum");
while($d = mysqli_fetch_array($data)){
?>
<div class="modal fade" id="ubahPesertaPraktikumModal<?php echo $d['nim'] . '_' . $d['id_praktikum']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahPesertaPraktikumModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahPesertaPraktikumModalLabel">Ubah Peserta Praktikum</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="ubahPesertaPraktikum.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="nim_lama" value="<?php echo $d['nim']; ?>">
                    <input type="hidden" name="id_praktikum_lama" value="<?php echo $d['id_praktikum']; ?>">
                    
                    <div class="form-group">
                        <label>Nama Mahasiswa</label>
                        <select name="nim" class="form-control" required>
                            <?php 
                            $peserta = mysqli_query($koneksi, "SELECT * FROM peserta");
                            while($p = mysqli_fetch_array($peserta)){
                            ?>
                                <option value="<?php echo $p['nim']; ?>" 
                                    <?php echo ($p['nim'] == $d['nim']) ? 'selected' : ''; ?>>
                                    <?php echo $p['nama_mhs'] . " - " . $p['nim']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Praktikum</label>
                        <select name="id_praktikum" class="form-control" required>
                            <?php 
                            $praktikum = mysqli_query($koneksi, "SELECT p.*, mk.nama_mk FROM praktikum p 
                                                                JOIN mata_kuliah mk ON p.kode_mk = mk.kode_mk");
                            while($pr = mysqli_fetch_array($praktikum)){
                            ?>
                                <option value="<?php echo $pr['id_praktikum']; ?>" 
                                    <?php echo ($pr['id_praktikum'] == $d['id_prakt ikum']) ? 'selected' : ''; ?>>
                                    <?php echo $pr['nama_praktikum'] . " - " . $pr['nama_mk']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Tanggal Daftar</label>
                        <input type="date" name="tgl_daftar" class="form-control" required value="<?php echo $d['tgl_daftar']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>