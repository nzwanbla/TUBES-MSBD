<?php

require './include/Admin_function.php';

if (empty($_SESSION['username']) or $_SESSION['status'] != 'Admin') {
	header("Location: ./error-403.php");
}

$res = getDataRequest();

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
				<li><a href="#">Request Perpanjangan</a>
					<section style="max-height: 500px; overflow-y: auto;">
						<div class="card mb-4">
							<div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
								<h4 class="m-0 font-weight-bold text-primary">Request Perpanjangan Peminjaman</h4>
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
											<th>Waktu request</th>
											<th>status</th>
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
												<td><?= date('d-m-Y', strtotime($data['waktu_request'])) ?></td>
												<td>
													<?= ($data['waktu_pengembalian'] != NULL and $data['status'] == "Pending") ? 'Selesai' : $data['status'] ?>
												</td>
												<td>

													<button type="button"
														class="btn btn-outline-success mt-2 d-flex justify-content-center align-items-center"
														data-bs-toggle="modal" data-bs-target="#tombolSetuju"
														data-id="<?= $data['id_request'] ?>"
														data-id_peminjaman="<?= $data['id_peminjaman_buku'] ?>"
														data-id_user="<?= $data['id_user'] ?>"
														<?= ($data['waktu_pengembalian'] != NULL || $data['status'] != 'Pending') ? 'disabled' : '' ?>>
														<i class="bi bi-check"></i>
													</button>
													<button type="button"
														class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center"
														data-bs-toggle="modal" data-bs-target="#tombolTolak"
														data-id="<?= $data['id_request'] ?>"
														data-id_peminjaman="<?= $data['id_peminjaman_buku'] ?>"
														data-id_user="<?= $data['id_user'] ?>"
														<?= ($data['waktu_pengembalian'] != NULL || $data['status'] != 'Pending') ? 'disabled' : '' ?>>
														<i class="bi bi-x"></i>
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

	<!-- Modal Setuju -->
	<div class="modal fade" id="tombolSetuju">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Konfirmasi Perpanjangan</h4>
					<button type="button" class="close" data-bs-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					Apakah Anda yakin ingin menyetujui permintaan perpanjangan ini?
				</div>
				<div class="modal-footer">
					<form action="" method="POST">
						<input type="hidden" name="id_request" id="setujuIdRequest">
						<input type="hidden" name="id_user" id="setujuIdUser">
						<input type="hidden" name="id_peminjaman_buku" id="setujuIdPeminjaman">
						<button type="submit" name="btnSetuju" class="btn btn-success">Setujui</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Tolak -->
	<div class="modal fade" id="tombolTolak">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Konfirmasi Penolakan</h4>
					<button type="button" class="close" data-bs-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					Apakah Anda yakin ingin menolak permintaan perpanjangan ini?
				</div>
				<div class="modal-footer">
					<form action="" method="POST">
						<input type="hidden" name="id_request" id="tolakIdRequest">
						<input type="hidden" name="id_user" id="tolakIdUser">
						<input type="hidden" name="id_peminjaman_buku" id="tolakIdPeminjaman">
						<button type="submit" name="btnTolak" class="btn btn-danger">Tolak</button>
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
		// Menangani data ketika modal Setuju dibuka
		$('#tombolSetuju').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget); // Tombol yang diklik
			var idRequest = button.data('id'); // Mengambil id_request
			var idUser = button.data('id_user'); // Mengambil id_user
			var idPeminjaman = button.data('id_peminjaman');

			// Menyimpan data ke dalam hidden field
			$('#setujuIdRequest').val(idRequest);
			$('#setujuIdUser').val(idUser);
			$('#setujuIdPeminjaman').val(idPeminjaman);
		});

		// Menangani data ketika modal Tolak dibuka
		$('#tombolTolak').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget); // Tombol yang diklik
			var idRequest = button.data('id'); // Mengambil id_request
			var idUser = button.data('id_user'); // Mengambil id_user
			var idPeminjaman = button.data('id_peminjaman');

			// Menyimpan data ke dalam hidden field
			$('#tolakIdRequest').val(idRequest);
			$('#tolakIdUser').val(idUser);
			$('#tolakIdPeminjaman').val(idPeminjaman);
		});
	</script>

	<?php include "./crud/approve_request.php" ?>
</body>

</html>