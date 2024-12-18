<?php
require '../../vendor/autoload.php';
require './include/Admin_Function.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// 1. Query data dari database
$res = query("SELECT * FROM view_denda_buku WHERE YEAR(waktu_peminjaman) = YEAR(current_date) 
                AND MONTH(waktu_peminjaman) = MONTH(current_date)");    

// 2. Definisikan data header untuk file Excel
$data = [
    ['No', 'Nama Peminjam', 'Kelas', 'Id Eks Buku', 'Judul', 'Waktu Peminjaman', 'Biaya Denda', 'Keterangan'],
];

// 3. Jika ada data, masukkan ke dalam array
if (!empty($res)) {
    $no = 1;
    foreach ($res as $row){
        $data[] = [
            $no++, // Nomor urut
            $row['nama_user'],
            $row['kelas'],
            $row['id_eksemplar_buku'],
            $row['judul_buku'],
            $row['waktu_peminjaman'],
            'Rp. ' . number_format($row['besaran_denda'], 0, ',', '.'),
            $row['keterangan']
        ];
    }
} else {
    echo "Tidak ada data peminjaman.";
    exit;
}

// 4. Buat Spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// 5. Tambahkan judul besar di bagian atas
$sheet->setCellValue('A1', 'Perpustakaan SMAN 2 Binjai');
$sheet->mergeCells('A1:H1'); // Gabungkan sel dari A1 hingga G1 untuk judul besar
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16); // Buat judul lebih besar dan tebal
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Rata tengah judul besar

$sheet->setCellValue('A2', 'Laporan Denda Buku');
$sheet->mergeCells('A2:H2'); // Gabungkan sel dari A2 hingga G2
$sheet->getStyle('A2')->getFont()->setBold(true)->setSize(14); 
$sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Rata tengah sub-judul

// 6. Isi data header (baris ke-4)
$sheet->fromArray($data[0], NULL, 'A4');

// 7. Isi data mulai dari baris ke-5
$sheet->fromArray(array_slice($data, 1), NULL, 'A5');

// 8. Styling Header
$sheet->getStyle('A4:H4')->getFont()->setBold(true); // Tebalkan header
$sheet->getStyle('A4:H4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Rata tengah header
$sheet->getStyle('A4:H4')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFE599'); // Background header warna kuning

// 9. Buat border untuk seluruh data
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
        ],
    ],
];
$sheet->getStyle('A4:H'.(count($data) + 3))->applyFromArray($styleArray); // Border untuk semua sel

// 10. Atur agar seluruh konten berada di tengah
$sheet->getStyle('A4:H'.(count($data) + 4))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Semua konten rata tengah
$sheet->getStyle('A4:H'.(count($data) + 4))->getAlignment()->setVertical(Alignment::VERTICAL_CENTER); // Semua konten rata vertikal

// 11. Auto size untuk semua kolom
foreach(range('A', 'H') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true); // Sesuaikan ukuran kolom secara otomatis
}

// 12. Atur header HTTP untuk mengunduh file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Laporan_Denda_Buku_' . date('F_Y') . '.xlsx"');
header('Cache-Control: max-age=0');

// 13. Tulis file Excel ke output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
