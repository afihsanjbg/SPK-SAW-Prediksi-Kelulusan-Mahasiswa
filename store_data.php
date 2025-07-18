<?php
session_start();

// Fungsi bantu
function clean_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Ambil dan bersihkan input
$nama = clean_input($_POST['nama'] ?? '');
$nim = clean_input($_POST['nim'] ?? '');
$prodi = clean_input($_POST['prodi'] ?? '');
$semester = clean_input($_POST['semester'] ?? '');
$ipk_now = clean_input($_POST['ipk_now'] ?? '');
$jumlah_sks = clean_input($_POST['jumlah_sks'] ?? '');
$kehadiran = clean_input($_POST['kehadiran'] ?? '');
$jumlah_sp = clean_input($_POST['jumlah_sp'] ?? '');
$aktivitas = clean_input($_POST['aktivitas'] ?? '');
$pgrs_ta = clean_input($_POST['pgrs_ta'] ?? '');

// Validasi...
$required_fields = [
    'nama' => $nama,
    'nim' => $nim,
    'prodi' => $prodi,
    'semester' => $semester,
    'ipk_now' => $ipk_now,
    'jumlah_sks' => $jumlah_sks,
    'kehadiran' => $kehadiran,
    'jumlah_sp' => $jumlah_sp,
    'aktivitas' => $aktivitas,
    'pgrs_ta' => $pgrs_ta
];

foreach ($required_fields as $key => $value) {
    if (!isset($value) || (is_string($value) && trim($value) === '') && $value !== '0') {
        echo json_encode(['status' => 'error', 'message' => 'Semua field wajib diisi.']);
        exit;
    }
}

// Validasi numerik
if (!preg_match('/^\d{6,12}$/', $nim) || !is_numeric($semester) || !is_numeric($ipk_now) ||
    !is_numeric($jumlah_sks) || !is_numeric($kehadiran) || !is_numeric($jumlah_sp)) {
    echo json_encode(['status' => 'error', 'message' => 'Format angka tidak valid.']);
    exit;
}

// Simpan ke session
$_SESSION['student_data'] = [
    'nama' => $nama,
    'nim' => $nim,
    'prodi' => $prodi,
    'semester' => $semester,
    'ipk_now' => $ipk_now,
    'jumlah_sks' => $jumlah_sks,
    'kehadiran' => $kehadiran,
    'jumlah_sp' => $jumlah_sp,
    'aktivitas' => $aktivitas,
    'pgrs_ta' => $pgrs_ta
];

// Kirim status ke frontend
echo json_encode(['status' => 'success']);
exit;
?>
