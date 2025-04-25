<?php
require_once '../../koneksi.php';

if (ob_get_level()) ob_end_clean();

$startDateGenerate = $_GET['startDateGenerate'] ?? '';
$endDateGenerate = $_GET['endDateGenerate'] ?? '';
$tglPenilaian = $_GET['tglPenilaian'] ?? '';

$query = "SELECT * FROM tb_penilaianstakeholder WHERE 1";
if (!empty($startDateGenerate) && !empty($endDateGenerate)) {
    $query .= " AND tanggal BETWEEN '$startDateGenerate' AND '$endDateGenerate'";
} elseif (!empty($tglPenilaian)) {
    $query .= " AND tanggal = '$tglPenilaian'";
}

$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

require_once('./library/fpdf.php');

$pdf = new FPDF('P', 'mm', 'A4'); // Portrait
$pdf->SetTitle('Laporan Penilaian Stakeholder');
$pdf->SetAuthor('Sistem Alumni');

$pdf->SetMargins(15, 20, 15); // Margin atas-kiri-kanan
$pdf->SetAutoPageBreak(true, 20);

$no = 1;
foreach ($data as $row) {
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'LAPORAN PENILAIAN STAKEHOLDER', 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(0, 8, 'No: ' . $no++, 0, 1);
    $pdf->Cell(0, 8, 'Tanggal: ' . date('d/m/Y', strtotime($row['tanggal'])), 0, 1);
    $pdf->Cell(0, 8, 'Stakeholder: ' . $row['nama_stakeholder'], 0, 1);
    $pdf->Cell(0, 8, 'Alumni: ' . $row['nama_alumni'], 0, 1);
    $pdf->Ln(3);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(0, 8, 'Penilaian:', 0, 1);

    $pdf->SetFont('Arial', '', 11);
    $nilai = [];
    $total_nilai = 0;
    for ($i = 1; $i <= 7; $i++) {
        $val = $row['pertanyaan_' . $i];
        $nilai[] = "P$i: $val";
        $total_nilai += $val;
    }

    $rata_rata = round($total_nilai / 7, 2);
    $pdf->MultiCell(0, 8, implode(' | ', $nilai));
    $pdf->Ln(2);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(0, 8, 'Rata-rata Penilaian:', 0, 1);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(0, 8, $rata_rata, 0, 1);
    $pdf->Ln(2);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(0, 8, 'Harapan:', 0, 1);
    $pdf->SetFont('Arial', '', 11);
    $pdf->MultiCell(0, 8, $row['harapan']);
    $pdf->Ln(2);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(0, 8, 'Saran / Masukan:', 0, 1);
    $pdf->SetFont('Arial', '', 11);
    $pdf->MultiCell(0, 8, $row['saran_masukan']);
}

$pdf->Output('D', 'laporan_penilaian_stakeholder_' . date('YmdHis') . '.pdf');
exit();
?>
