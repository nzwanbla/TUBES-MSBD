<?php

require './include/Petugas_function.php';

if (empty($_SESSION['username']) or $_SESSION['status'] != 'Petugas') {
	header("Location: ./error-403.php");
}

$res = getDataPeminjaman("Non Paket Pelajaran");
$res2 = getDataPeminjaman("Paket Pelajaran");

date_default_timezone_set('Asia/Jakarta');

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Perpustakaan SMAN 2 Binjai</title>

	<?php include "./include/css.php"; ?>

</head>

<>
	<div class="container-scroller">
		<!-- include:navbar.php -->
		<?php
		include "./include/navbar.php";
		?>

		<div class="container-fluid page-body-wrapper">
			<!-- include -->
			<!-- sidebar_settings.php -->
			<?php
			include "../../include/sidebar_setting.php";
			?>

			<!-- sidebar.php -->
			<?php
			include "./include/sidebar.php";
			?>
			<ul id="nav-tabs">
				<li><a href="#">Non Paket Pelajaran</a>
					<section style="max-height: 500px; overflow-y: auto;">
						<div class="card mb-4">
							<div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
								<h4 class="m-0 font-weight-bold text-primary">Laporan Data Peminjaman</h4>
								<!-- Tombol-tombol di sebelah kanan -->
								<div class="ml-auto">
									<button type="button" class="btn btn-primary" data-toggle="modal"
										data-target="#tambahPeminjaman">
										Tambah Peminjaman
									</button>
									<button type="button" class="btn btn-primary" data-toggle="modal"
										data-target="#tambahPengembalian">
										Tambah Pengembalian
									</button>
								</div>
							</div>

							<div class="table-responsive p-3">
								<table class="table align-items-center table-flush table-hover" id="dataTableHover1">
									<thead class="bg-primary text-white">
										<tr>
											<th>No</th>
											<th>Nama Peminjam</th>
											<th>Kelas</th>
											<th>Id Eks Buku</th>
											<th>Judul</th>
											<th>Tgl Dipinjam</th>
											<th>Jatuh Tempo</th>
											<th>Tgl Kembali</th>
											<th>Petugas</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										foreach ($res as $data) {
											?>
											<tr>
												<td><?= $i ?></td>
												<td><?= $data['nama_user'] ?></td>
												<td><?= $data['kelas'] ?></td>
												<td><?= $data['id_eksemplar_buku'] ?></td>
												<td><?= $data['judul_buku'] ?></td>
												<td><?= date('d-m-Y', strtotime($data['waktu_peminjaman'])) ?></td>
												<td>
                                                    <?php
                                                    // Hitung jatuh tempo
                                                    $tanggal_peminjaman = strtotime($data['waktu_peminjaman']);
                                                    $jatuh_tempo = $tanggal_peminjaman + ($data['perpanjangan'] ? (9 * 24 * 60 * 60) : (6 * 24 * 60 * 60));
                                                    echo date('d-m-Y', $jatuh_tempo);
                                                    ?>
                                                </td>
												<td><?php
												if ($data['waktu_pengembalian'] == null) {
													echo "-"; // Or a message like "Belum Kembali"
												} else {
													echo date('d-m-Y', strtotime($data['waktu_pengembalian']));
												}
												?></td>

												<td><?= $data['nama_petugas'] ?></td>
												<td>
													<?php
													$waktu_pengembalian = $data['waktu_pengembalian'];
													?>

													<!-- Tombol Pengembalian -->
													<button type="button"
														class="btn btn-outline-success mt-2 d-flex justify-content-center align-items-center"
														data-bs-toggle="modal" data-bs-target="#tombolPengembalian" <?php if ($waktu_pengembalian != null)
															echo 'disabled'; ?>
														data-id="<?= $data['id_peminjaman_buku'] ?>"
														data-nisn="<?= $data['no_induk'] ?>"
														data-id_eksemplar_buku="<?= $data['id_eksemplar_buku'] ?>">
														<i class="bi bi-clipboard-check"></i>
													</button>

													<!-- Tombol Denda -->
													<button type="button"
														class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center"
														data-bs-toggle="modal" data-bs-target="#tombolDenda" <?php if ($waktu_pengembalian != null) {
															echo 'disabled';
														} ?>
														data-id="<?= $data['id_peminjaman_buku'] ?>"
														data-nisn="<?= $data['no_induk'] ?>"
														data-id_eksemplar_buku="<?= $data['id_eksemplar_buku'] ?>">
														<i class="bi bi-clipboard-x"></i>
													</button>

													<!-- Tombol Edit -->
													<button type="button"
														class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center"
														data-bs-toggle="modal" data-bs-target="#tombolEdit" <?php if ($waktu_pengembalian != null) {
															echo 'disabled';
														} ?>
														data-id="<?= $data['id_peminjaman_buku'] ?>"
														data-nisn="<?= $data['no_induk'] ?>"
														data-id_eksemplar_buku="<?= $data['id_eksemplar_buku'] ?>"
														data-perpanjangan="<?= $data['perpanjangan']?>"
														data-waktu_peminjaman ="<?= $data['waktu_peminjaman']?>">
														<i class="bi bi-pencil"></i>
													</button>
												</td>
											</tr>
											<?php $i++;
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</section>
				</li>
				<li><a href="#">Paket Pelajaran</a>
					<section style="max-height: 500px; overflow-y: auto;">
						<div class="card mb-4">
							<div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
								<h4 class="m-0 font-weight-bold text-primary">Laporan Data Peminjaman</h4>
								<!-- <a href="" class="btn btn-primary">Ekspor ke Excel</a> -->
							</div>
							<div class="table-responsive p-3">
								<table class="table align-items-center table-flush table-hover" id="dataTableHover2">
									<thead class="bg-primary text-white">
										<tr>
											<th>No</th>
											<th>Nama Peminjam</th>
											<th>Kelas</th>
											<th>Id Eks Buku</th>
											<th>Judul</th>
											<th>Tgl Dipinjam</th>
											<th>Tgl Kembali</th>
											<th>Petugas</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										foreach ($res2 as $data2) {
											?>
											<tr>
												<td><?= $i ?></td>
												<td><?= $data2['nama_user'] ?></td>
												<td><?= $data2['kelas'] ?></td>
												<td><?= $data2['id_eksemplar_buku'] ?></td>
												<td><?= $data2['judul_buku'] ?></td>
												<td><?= date('d-m-Y', strtotime($data2['waktu_peminjaman'])) ?></td>

												<td><?php
												if ($data2['waktu_pengembalian'] == null) {
													echo "-"; // Or a message like "Belum Kembali"
												} else {
													echo date('d-m-Y', strtotime($data2['waktu_pengembalian']));
												}
												?></td>

												<td><?= $data2['nama_petugas'] ?></td>
												<td>
													<?php
													$waktu_pengembalian = $data2['waktu_pengembalian'];
													?>

													<!-- Tombol Pengembalian -->
													<button type="button"
														class="btn btn-outline-success mt-2 d-flex justify-content-center align-items-center"
														data-bs-toggle="modal" data-bs-target="#tombolPengembalian" <?php if ($waktu_pengembalian != null)
															echo 'disabled'; ?>
														data-id="<?= $data2['id_peminjaman_buku'] ?>"
														data-nisn="<?= $data2['no_induk'] ?>"
														data-id_eksemplar_buku="<?= $data2['id_eksemplar_buku'] ?>">
														<i class="bi bi-clipboard-check"></i>
													</button>

													<!-- Tombol Denda -->
													<button type="button"
														class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center"
														data-bs-toggle="modal" data-bs-target="#tombolDenda" <?php if ($waktu_pengembalian != null) {
															echo 'disabled';
														} ?>
														data-id="<?= $data2['id_peminjaman_buku'] ?>"
														data-nisn="<?= $data2['no_induk'] ?>"
														data-id_eksemplar_buku="<?= $data2['id_eksemplar_buku'] ?>">
														<i class="bi bi-clipboard-x"></i>
													</button>

													<!-- Tombol Edit -->
													<button type="button"
														class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center"
														data-bs-toggle="modal" data-bs-target="#tombolEdit" <?php if ($waktu_pengembalian != null) {
															echo 'disabled';
														} ?>
														data-id="<?= $data2['id_peminjaman_buku'] ?>"
														data-nisn="<?= $data2['no_induk'] ?>"
														data-id_eksemplar_buku="<?= $data2['id_eksemplar_buku'] ?>"
														data-perpanjangan="<?= $data2['perpanjangan']?>"
														data-waktu_peminjaman ="<?= $data2['waktu_peminjaman']?>">
														<i class="bi bi-pencil"></i>
													</button>
												</td>
											</tr>
											<?php $i++;
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</section>
				</li>
			</ul>
		</div>
	</div>
	<!-- include/footer.php -->
	<?php
	include "../../include/footer.php";
	?>
	</div>

	<?php include "./modal_data_peminjaman.php" ?>

	<?php include "./include/js.php"; ?>

	<script>
		function tambahInputBuku1() {
			// Mendapatkan jumlah buku yang dipilih oleh pengguna
			var jumlahBuku = document.getElementById('jumlah_buku').value;
			var container = document.getElementById('input_buku_container');

			// Menghapus input yang ada sebelumnya
			container.innerHTML = '';

			// Menambahkan input ID Eksemplar Buku sesuai dengan jumlah buku yang dipilih
			for (var i = 1; i <= jumlahBuku; i++) {
				var div = document.createElement('div');
				div.classList.add('form-group');
				div.innerHTML = '<label for="id_eksemplar_buku_' + i + '">ID Eksemplar Buku ' + i + '</label>' +
					'<input type="text" class="form-control" id="id_eksemplar_buku_' + i + '" name="id_eksemplar_buku[]" required>';
				container.appendChild(div);
			}
		}
	</script>

	<script>
		function tambahInputBuku2() {
			// Mendapatkan jumlah buku yang dipilih oleh pengguna
			var jumlahBuku = document.getElementById('jumlah_buku2').value;
			var container = document.getElementById('input_buku_container2');

			// Menghapus input yang ada sebelumnya
			container.innerHTML = '';

			// Menambahkan input ID Eksemplar Buku sesuai dengan jumlah buku yang dipilih
			for (var i = 1; i <= jumlahBuku; i++) {
				var div = document.createElement('div');
				div.classList.add('form-group');
				div.innerHTML = '<label for="id_eksemplar_buku_' + i + '">ID Eksemplar Buku ' + i + '</label>' +
					'<input type="text" class="form-control" id="id_eksemplar_buku_' + i + '" name="id_eksemplar_buku[]" required>';
				container.appendChild(div);
			}
		}
	</script>

	<script>
		$('#tombolPengembalian').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget); // Tombol yang diklik
			var idPeminjamanBuku = button.data('id'); // Ambil id_peminjaman_buku dari data-id
			var nisn = button.data('nisn'); // Ambil NISN dari data-nisn
			var idEksemplarBuku = button.data('id_eksemplar_buku'); // Ambil id_eksemplar_buku dari data-id_eksemplar_buku

			// Set data ke dalam modal
			var modal = $(this);
			modal.find('#id_peminjaman_buku').val(idPeminjamanBuku);
			modal.find('#nisn').val(nisn);
			modal.find('#id_eksemplar_buku').val(idEksemplarBuku);
		});
	</script>

	<script>
		$('#tombolDenda').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget); // Tombol yang diklik
			var idPeminjamanBuku = button.data('id'); // Ambil id_peminjaman_buku dari data-id
			var nisn = button.data('nisn'); // Ambil NISN dari data-nisn
			var idEksemplarBuku = button.data('id_eksemplar_buku'); // Ambil id_eksemplar_buku dari data-id_eksemplar_buku

			// Set data ke dalam modal
			var modal = $(this);
			modal.find('#id_peminjaman_buku').val(idPeminjamanBuku);
			modal.find('#nisn').val(nisn);
			modal.find('#id_eksemplar_buku').val(idEksemplarBuku);
		});
	</script>

	<script>
		$('#tombolEdit').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget); // Tombol yang diklik
			var idPeminjamanBuku = button.data('id'); // Ambil id_peminjaman_buku dari data-id
			var nisn = button.data('nisn'); // Ambil NISN dari data-nisn
			var idEksemplarBuku = button.data('id_eksemplar_buku'); // Ambil id_eksemplar_buku dari data-id_eksemplar_buku
			var perpanjangan = button.data('perpanjangan');
			var waktu_peminjaman = button.data('waktu_peminjaman');

			// Set data ke dalam modal
			var modal = $(this);
			modal.find('#id_peminjaman_buku').val(idPeminjamanBuku);
			modal.find('#nisn').val(nisn);
			modal.find('#id_eksemplar_buku').val(idEksemplarBuku);
			modal.find('#waktu_peminjaman').val(waktu_peminjaman);

			// Reset radio buttons role terlebih dahulu
			$('input[name="perpanjangan"]').prop('checked', false); // Menghapus status yang terpilih sebelumnya

			// Menandai radio button yang sesuai dengan role
			if (perpanjangan === 0) {
				$('#perpanjangan0').prop('checked', true); // Check radio button Pengunjung
			} else if (perpanjangan === 1) {
				$('#perpanjangan1').prop('checked', true); // Check radio button Non Aktif
			}
		});
	</script>






	<!-- Page level custom scripts -->
	<script>
		$(document).ready(function () {
			$('#dataTable').DataTable(); // ID From dataTable 
			$('#dataTableHover1').DataTable(); // ID From dataTable with Hover
			$('#dataTableHover2').DataTable(); // ID From dataTable with Hover
		});
	</script>

	<?php include "./crud/input_peminjaman.php"; ?>
	<?php include "./crud/input_pengembalian.php" ?>
	<?php include "./crud/input_denda.php" ?>
	<?php include "./crud/edit_peminjaman.php" ?>

	</body>

</html>