<?php

require './include/Petugas_function.php';

if (empty($_SESSION['username']) or $_SESSION['status'] != 'Petugas') {
	header("Location: ./error-403.php");
}

$res = getDataDenda();

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

<body>
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
				<li><a href="#">Denda Peminjaman</a>
					<section style="max-height: 500px; overflow-y: auto;">
						<div class="card mb-4">
							<div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
								<h4 class="m-0 font-weight-bold text-primary">Laporan Denda Peminjaman</h4>
								<!-- Tombol-tombol di sebelah kanan -->
								<div class="ml-auto">
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
											<th>Biaya Denda</th>
											<th>Keterangan</th>
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
												<td>Rp. <?= $data['besaran_denda'] ?></td>
												<td><?= $data['keterangan'] ?></td>
												<td>

													<button type="button"
														class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center"
														data-bs-toggle="modal" data-bs-target="#tombolEdit"
														data-id="<?= $data['id_peminjaman_buku']?>"
														data-id_eksemplar_buku="<?= $data['id_eksemplar_buku']?>"
														data-id_denda_buku="<?= $data['id_denda_buku']?>"
														data-nisn="<?= $data['no_induk']?>"
														data-judul="<?= $data['judul_buku']?>"
														data-keterangan="<?= $data['keterangan']?>"
														data-denda="<?= $data['besaran_denda']?>">
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

	<div class="modal fade" id="tombolEdit">
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
						 
						<input type="hidden" id="id_denda_buku" name="id_denda_buku">
						<input type="hidden" id="id_peminjaman_buku" name="id_peminjaman_buku">

						<!-- No Induk (NISN) -->
						<div class="form-group">
							<label for="nisn">NISN/NIP</label>
							<input type="text" class="form-control" id="nisn" name="nisn" readonly>
						</div>
						<!-- ID Eksemplar Buku -->
						<div class="form-group">
							<label for="id_eksemplar_buku">ID Eksemplar Buku</label>
							<input type="text" class="form-control" id="id_eksemplar_buku" name="id_eksemplar_buku"
								readonly>
						</div>
						<div class="form-group">
							<label for="judul">judul Buku</label>
							<input type="text" class="form-control" id="judul" name="judul"
								readonly>
						</div>

						<label>Keterangan Denda<small class="text-danger">*</small></label><br>
						<div class="form-group row">
							<div class="col-sm-5">
								<div class="form-check">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="keterangan"
											id="keteranganHilang" value="Hilang" required>
										Hilang
									</label>
								</div>
							</div>
							<div class="col-sm-5">
								<div class="form-check">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="keterangan"
											id="keteranganRusak" value="Rusak" required>
										Rusak
									</label>
								</div>
							</div>
							<div class="col-sm-5">
								<div class="form-check">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="keterangan"
											id="keteranganTelat" value="Telat" required>
										Telat
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="denda">Biaya Denda</label>
							<input type="number" class="form-control" id="denda" name="denda" min="0">
						</div>

						<button type="submit" name="btnEdit" class="btn btn-primary">Simpan Perubahan</button>
					</form>
				</div>
			</div>
		</div>
	</div>



	<?php include "./include/js.php"; ?>

	<!-- Page level custom scripts -->
	<script>
		$(document).ready(function () {
			$('#dataTable').DataTable(); // ID From dataTable 
			$('#dataTableHover1').DataTable(); // ID From dataTable with Hover
			$('#dataTableHover2').DataTable(); // ID From dataTable with Hover
		});
	</script>

	<script>
		$('#tombolEdit').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget); // Tombol yang diklik
			var idPeminjamanBuku = button.data('id'); // Ambil id_peminjaman_buku dari data-id
			var nisn = button.data('nisn'); // Ambil NISN dari data-nisn
			var idEksemplarBuku = button.data('id_eksemplar_buku'); // Ambil id_eksemplar_buku dari data-id_eksemplar_buku
			var idDendaBuku = button.data('id_denda_buku');
			var judul = button.data('judul');
			var denda = button.data('denda');
			var keterangan = button.data('keterangan');

			// Set data ke dalam modal
			var modal = $(this);
			modal.find('#id_peminjaman_buku').val(idPeminjamanBuku);
			modal.find('#nisn').val(nisn);
			modal.find('#id_eksemplar_buku').val(idEksemplarBuku);
			modal.find('#id_denda_buku').val(idDendaBuku);
			modal.find('#judul').val(judul);
			modal.find('#denda').val(denda);

			// Reset radio buttons role terlebih dahulu
			$('input[name="keterangan"]').prop('checked', false); // Menghapus status yang terpilih sebelumnya

			// Menandai radio button yang sesuai dengan role
			if (keterangan === "Hilang") {
				$('#keteranganHilang').prop('checked', true); // Check radio button Pengunjung
			} else if (keterangan === "Rusak") {
				$('#keteranganRusak').prop('checked', true); // Check radio button Non Aktif
			} else if (keterangan === "Telat") {
				$('#keteranganTelat').prop('checked', true); // Check radio button Non Aktif
			}
		});
	</script>

	<?php include "./crud/edit_denda.php"?>
</body>

</html>