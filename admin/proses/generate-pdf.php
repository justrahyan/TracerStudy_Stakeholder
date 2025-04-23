<?php
require_once '../../koneksi.php';

// Pastikan tidak ada output sebelum header
if (ob_get_level()) ob_end_clean();

// Ambil data langsung dari GET parameter
$startDateGenerate = $_GET['startDateGenerate'] ?? '';
$endDateGenerate = $_GET['endDateGenerate'] ?? '';
$tglPenilaian = $_GET['tglPenilaian'] ?? '';

// Query data langsung (tanpa session)
$query = "SELECT * FROM tb_penilaianstakeholder WHERE 1";
if (!empty($startDateGenerate) && !empty($endDateGenerate)) {
    $query .= " AND tanggal BETWEEN '$startDateGenerate' AND '$endDateGenerate'";
} elseif (!empty($tglPenilaian)) {
    $query .= " AND tanggal = '$tglPenilaian'";
}

$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

require_once('./library/fpdf.php');

$pdf = new FPDF();
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

// Set document information
$pdf->SetTitle('Laporan Penilaian Stakeholder');
$pdf->SetAuthor('Sistem Alumni');

// Title
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'LAPORAN PENILAIAN STAKEHOLDER', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, $title, 0, 1, 'C');
$pdf->Ln(10);

// Table header
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(10, 7, 'No', 1, 0, 'C', true);
$pdf->Cell(50, 7, 'Nama Stakeholder', 1, 0, 'C', true);
$pdf->Cell(50, 7, 'Nama Alumni', 1, 0, 'C', true);
$pdf->Cell(30, 7, 'Tanggal', 1, 0, 'C', true);
$pdf->Cell(30, 7, 'Nilai Rata-rata', 1, 1, 'C', true);

// Table content
$pdf->SetFont('Arial', '', 9);
$no = 1;
foreach ($data as $row) {
    $total_nilai = $row['pertanyaan_1'] + $row['pertanyaan_2'] + $row['pertanyaan_3'] + 
                  $row['pertanyaan_4'] + $row['pertanyaan_5'] + $row['pertanyaan_6'] + 
                  $row['pertanyaan_7'];
    $rata_rata = round($total_nilai / 7, 2);
    
    $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    $pdf->Cell(50, 6, $row['nama_stakeholder'], 1, 0, 'L');
    $pdf->Cell(50, 6, $row['nama_alumni'], 1, 0, 'L');
    $pdf->Cell(30, 6, date('d/m/Y', strtotime($row['tanggal'])), 1, 0, 'C');
    $pdf->Cell(30, 6, $rata_rata, 1, 1, 'C');
}

// Output langsung
$pdf->Output('D', 'laporan_penilaian_stakeholder_'.date('YmdHis').'.pdf');
exit();
?>