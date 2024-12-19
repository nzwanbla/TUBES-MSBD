<!-- Modal Pengembalian -->
<!-- Modal untuk Formulir Peminjaman -->
<div class="modal fade" id="tambahPeminjaman">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Peminjaman</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">

                    <div class="form-group">
                        <label for="nisn">NISN/NIP</label>
                        <input type="text" class="form-control" id="nisn" name="nisn" required>
                    </div>

                    <div class="form-group">
                        <label for="waktu_peminjaman">Waktu Peminjaman</label>
                        <input type="text" class="form-control" id="waktu_peminjaman" name="waktu_peminjaman"
                            value="<?= date('d-m-Y H:i:s') ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_buku">Jumlah Buku yang Dipinjam</label>
                        <input type="number" class="form-control" id="jumlah_buku" name="jumlah_buku" value="1" min="1"
                            onchange="tambahInputBuku1()">
                    </div>

                    <!-- Tempat untuk input ID Eksemplar Buku -->
                    <div id="input_buku_container">
                        <div class="form-group">
                            <label for="id_eksemplar_buku_1">ID Eksemplar Buku 1</label>
                            <input type="text" class="form-control" id="id_eksemplar_buku_1" name="id_eksemplar_buku[]"
                                required>
                        </div>
                    </div>

                    <button type="submit" name="btnTambahPeminjaman" class="btn btn-primary">Simpan
                        Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahPengembalian">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pengembalian Buku</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">

                    <div class="form-group">
                        <label for="nisn">NISN/NIP</label>
                        <input type="text" class="form-control" id="nisn" name="nisn" required>
                    </div>

                    <div class="form-group">
                        <label for="waktu_pengembalian">Waktu Pengembalian</label>
                        <input type="text" class="form-control" id="waktu_pengembalian" name="waktu_pengembalian"
                            value="<?= date('d-m-Y H:i:s') ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_buku">Jumlah Buku yang Dikembalikan</label>
                        <input type="number" class="form-control" id="jumlah_buku2" name="jumlah_buku" value="1" min="1"
                            onchange="tambahInputBuku2()">
                    </div>

                    <!-- Tempat untuk input ID Eksemplar Buku -->
                    <div id="input_buku_container2">
                        <div class="form-group">
                            <label for="id_eksemplar_buku_1">ID Eksemplar Buku 1</label>
                            <input type="text" class="form-control" id="id_eksemplar_buku_1" name="id_eksemplar_buku[]"
                                required>
                        </div>
                    </div>

                    <button type="submit" name="btnPengembalian" class="btn btn-primary">Simpan
                        Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tombolPengembalian">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pengembalian Buku</h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Form Pengembalian -->
                <form action="" method="POST">
                    <!-- ID Peminjaman Buku -->
                    <input type="hidden" id="id_peminjaman_buku" name="id_peminjaman_buku">

                    <!-- No Induk (NISN) -->
                    <div class="form-group">
                        <label for="nisn">NISN/NIP</label>
                        <input type="text" class="form-control" id="nisn" name="nisn" readonly>
                    </div>

                    <div class="form-group">
                        <label for="waktu_pengembalian">Waktu Pengembalian</label>
                        <input type="text" class="form-control" id="waktu_pengembalian" name="waktu_pengembalian"
                            value="<?= date('d-m-Y H:i:s') ?>" disabled>
                    </div>

                    <!-- ID Eksemplar Buku -->
                    <div class="form-group">
                        <label for="id_eksemplar_buku">ID Eksemplar Buku</label>
                        <input type="text" class="form-control" id="id_eksemplar_buku" name="id_eksemplar_buku[]"
                            readonly>
                    </div>

                    <button type="submit" name="btnPengembalian" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tombolDenda">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Denda Buku</h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Form Pengembalian -->
                <form action="" method="POST">
                    <!-- ID Peminjaman Buku -->
                    <input type="hidden" id="id_peminjaman_buku" name="id_peminjaman_buku">

                    <!-- No Induk (NISN) -->
                    <div class="form-group">
                        <label for="nisn">NISN/NIP</label>
                        <input type="text" class="form-control" id="nisn" name="nisn" readonly>
                    </div>

                    <div class="form-group">
                        <label for="waktu_pengembalian">Waktu Pengembalian</label>
                        <input type="text" class="form-control" id="waktu_pengembalian" name="waktu_pengembalian"
                            value="<?= date('d-m-Y H:i:s') ?>" disabled>
                    </div>

                    <!-- ID Eksemplar Buku -->
                    <div class="form-group">
                        <label for="id_eksemplar_buku">ID Eksemplar Buku</label>
                        <input type="text" class="form-control" id="id_eksemplar_buku" name="id_eksemplar_buku[]"
                            readonly>
                    </div>

                    <label>Keterangan Buku<small class="text-danger">*</small></label><br>
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="keterangan" id="keteranganHilang"
                                        value="Hilang" required>
                                    Hilang
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="keterangan" id="keteranganRusak"
                                        value="Rusak" required>
                                    Rusak
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="denda">Biaya Denda</label>
                        <input type="number" class="form-control" id="denda" name="denda" min="0">
                    </div>

                    <button type="submit" name="btnDenda" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tombolEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Peminjaman</h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Form Pengembalian -->
                <form action="" method="POST">
                    <!-- ID Peminjaman Buku -->
                    <input type="hidden" id="id_peminjaman_buku" name="id_peminjaman_buku">

                    <!-- No Induk (NISN) -->
                    <div class="form-group">
                        <label for="nisn">NISN/NIP</label>
                        <input type="text" class="form-control" id="nisn" name="nisn">
                    </div>

                    <div class="form-group">
                        <label for="waktu_peminjaman">Waktu Peminjaman</label>
                        <input type="text" class="form-control" id="waktu_peminjaman" name="waktu_peminjaman" disabled>
                    </div>

                    <!-- ID Eksemplar Buku -->
                    <div class="form-group">
                        <label for="id_eksemplar_buku">ID Eksemplar Buku</label>
                        <input type="text" class="form-control" id="id_eksemplar_buku" name="id_eksemplar_buku">
                    </div>

                    <label>Status Perpanjangan<small class="text-danger">*</small></label><br>
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="perpanjangan" id="perpanjangan0"
                                        value="0" required>
                                    Tidak Perpanjang
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="perpanjangan" id="perpanjangan1"
                                        value="1" required>
                                    Perpanjang
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" name="btnEdit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>