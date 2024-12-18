<?php
require '../../vendor/autoload.php';
require './include/Admin_Function.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$res = getDataDenda();

// Data yang diekspor (diambil dari database atau langsung didefinisikan)
$data = [
    ['No', 'Nama Peminjam', 'Kelas', 'Id Eks Buku', 'Judul', 'Biaya Denda', 'Keterangan'],
];

if (!empty($res)) {
    $no = 1;
    foreach ($res as $row){
        $data[] = [
            $no++, // Nomor urut
            $row['nama_user'],
            $row['kelas'],
            $row['id_eksemplar_buku'],
            $row['judul_buku'],
            'Rp. ' . number_format($row['besaran_denda'], 0, ',', '.'),
            $row['keterangan']
        ];
    }
} else {
    echo "Tidak ada data peminjaman.";
    exit;
}

// Buat Spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// 6. Tambahkan judul besar di bagian atas
$sheet->setCellValue('A1', 'Perpustakaan SMAN 2 Binjai');
$sheet->mergeCells('A1:J1'); // Gabungkan sel dari A1 hingga J1 untuk judul
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16); // Buat judul lebih besar dan tebal
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Rata tengah judul

$sheet->setCellValue('A2', 'Laporan Denda Buku');
$sheet->mergeCells('A2:J2'); 
$sheet->getStyle('A2')->getFont()->setBold(true)->setSize(14); 
$sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); 


// 7. Isi data header (baris ke-3)
$sheet->fromArray($data[0], NULL, 'A4');

// 8. Isi data mulai dari baris ke-4
$sheet->fromArray(array_slice($data, 1), NULL, 'A5');

// 9. Styling Header
$sheet->getStyle('A4:J4')->getFont()->setBold(true); // Tebalkan header
$sheet->getStyle('A4:J4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Rata tengah header
$sheet->getStyle('A4:J4')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFE599'); // Background header warna kuning

// 10. Buat border untuk seluruh data
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
        ],
    ],
];
$sheet->getStyle('A4:J'.(count($data) + 3))->applyFromArray($styleArray);

// 11. Auto size untuk semua kolom
foreach(range('A', 'J') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// 12. Atur header HTTP untuk mengunduh file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Laporan_Buku.xlsx"');
header('Cache-Control: max-age=0');

// 13. Tulis file Excel ke output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
