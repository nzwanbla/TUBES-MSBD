<?php
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Data yang diekspor (diambil dari database atau langsung didefinisikan)
$data = [
    ['No', 'ID Peminjaman', 'Nama Peminjam', 'Judul Buku', 'Tanggal Peminjaman', 'Jatuh Tempo', 'Tanggal Pengembalian', 'Denda', 'Status', 'Petugas'],
    [1, 'P001', 'Aldi', 'Sang Pemimpi', '01-11-2024', '08-11-2024', '-', 'Rp. 0', 'Dipinjam', '-'],
    [2, 'P002', 'Laila', 'Sejarah Diplomasi Indonesia', '01-11-2024', '08-11-2024', '08-11-2024', 'Rp. 0', 'Dikembalikan', '-'],
    [3, 'P003', 'Putra', 'Negeri Para Bedebah', '01-11-2024', '08-11-2024', '-', 'Rp. 10.000', 'Terlambat', '-'],
    [4, 'P004', 'Mahen', 'Kiat Menulis Karya Ilmiah', '01-11-2024', '08-11-2024', '-', '-', 'Dipinjam', '-'],
    [5, 'P005', 'Citra', 'Sang Pemimpi', '01-11-2024', '08-11-2024', '-', 'Rp. 10.000', 'Terlambat', '-'],
    [6, 'P006', 'Budi', 'Pulang', '01-11-2024', '08-11-2024', '07-11-2024', 'Rp. 0', 'Dikembalikan', '-'],
];

// Buat Spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Isi data ke dalam sheet
foreach ($data as $rowIndex => $row) {
    foreach ($row as $colIndex => $value) {
        // Baris dan kolom dimulai dari 1 (A1, B1, dst.)
        $sheet->setCellValueByColumnAndRow($colIndex + 1, $rowIndex + 1, $value);
    }
}

// Atur header HTTP untuk mengunduh file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Data_Pengembalian_Buku.xlsx"');
header('Cache-Control: max-age=0');

// Tulis file Excel ke output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
