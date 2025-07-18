<?php
include 'koneksi.php';

// Ambil data
$sql = "SELECT * FROM datamain";
$result = $koneksi->query($sql);

$students = [];
$no = 1;

while ($row = $result->fetch_assoc()) {
    $students[] = [
        "no" => $no++,
        "nama" => $row["nama"],
        "nim" => $row["nim"],
        "prodi" => $row["prodi"],
        "semester" => (int)$row["semester"],
        "ipk" => (float)$row["ipk_now"],
        "sks" => (int)$row["jumlah_sks"],
        "kehadiran" => (int)$row["kehadiran"],
        "sp" => (int)$row["jumlah_sp"],
        "aktivitas" => $row["aktivitas"],
        "progres" => $row["pgrs_ta"]
    ];
}

// Output dalam format JSON
header('Content-Type: application/json');
echo json_encode($students);
?>
