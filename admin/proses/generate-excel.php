<?php
require_once '../../koneksi.php';

if (ob_get_level()) ob_end_clean();

$title = $_GET['title'] ?? 'Laporan Penilaian';

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

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="laporan_penilaian_stakeholder_'.date('YmdHis').'.xls"');
header('Cache-Control: max-age=0');

echo "<table border='1'>";
echo "<tr><th colspan='11'>{$title}</th></tr>";
echo "<tr>
        <th>No</th>
        <th>Nama Stakeholder</th>
        <th>Nama Alumni</th>
        <th>Tanggal</th>
        <th>Pertanyaan 1</th>
        <th>Pertanyaan 2</th>
        <th>Pertanyaan 3</th>
        <th>Pertanyaan 4</th>
        <th>Pertanyaan 5</th>
        <th>Pertanyaan 6</th>
        <th>Pertanyaan 7</th>
        <th>Rata-rata</th>
      </tr>";

$no = 1;
foreach ($data as $row) {
    $total_nilai = $row['pertanyaan_1'] + $row['pertanyaan_2'] + $row['pertanyaan_3'] + 
                  $row['pertanyaan_4'] + $row['pertanyaan_5'] + $row['pertanyaan_6'] + 
                  $row['pertanyaan_7'];
    $rata_rata = round($total_nilai / 7, 2);
    
    echo "<tr>
            <td>$no</td>
            <td>".htmlspecialchars($row['nama_stakeholder'])."</td>
            <td>".htmlspecialchars($row['nama_alumni'])."</td>
            <td>".date('d/m/Y', strtotime($row['tanggal']))."</td>
            <td>".$row['pertanyaan_1']."</td>
            <td>".$row['pertanyaan_2']."</td>
            <td>".$row['pertanyaan_3']."</td>
            <td>".$row['pertanyaan_4']."</td>
            <td>".$row['pertanyaan_5']."</td>
            <td>".$row['pertanyaan_6']."</td>
            <td>".$row['pertanyaan_7']."</td>
            <td>".$rata_rata."</td>
          </tr>";
    $no++;
}

echo "</table>";

// Clear session data
unset($_SESSION['report_data']);
unset($_SESSION['report_title']);
exit();
?>