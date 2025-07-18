<?php
include 'koneksi.php';

// Fungsi bantu untuk membersihkan input
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

// Validasi input dasar
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
        echo "Semua field wajib diisi.";
        exit;
    }
}

// Validasi panjang karakter
if (!preg_match('/^\d{6,12}$/', $nim)) {
    echo "NIM harus berupa angka dan terdiri dari 6 sampai 12 digit.";
    exit;
}

// Validasi numerik
if (!is_numeric($nim) || !is_numeric($semester) || !is_numeric($ipk_now) ||
    !is_numeric($jumlah_sks) || !is_numeric($kehadiran) || !is_numeric($jumlah_sp)
) {
    echo "Field numerik harus berupa angka.";
    exit;
}

// Cek duplikasi NIM
$check_stmt = $koneksi->prepare("SELECT id FROM datamain WHERE nim = ?");
$check_stmt->bind_param("s", $nim);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    echo "NIM sudah pernah dimasukkan.";
    $check_stmt->close();
    exit;
}
$check_stmt->close();

// Insert data dengan prepared statement
$stmt = $koneksi->prepare("INSERT INTO datamain 
    (id, nama, nim, prodi, semester, ipk_now, jumlah_sks, kehadiran, jumlah_sp, aktivitas, pgrs_ta) 
    VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sisidiiiss", 
    $nama, $nim, $prodi, 
    $semester, $ipk_now, $jumlah_sks, 
    $kehadiran, $jumlah_sp, 
    $aktivitas, $pgrs_ta
);


if ($stmt->execute()) {
    echo "success";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$koneksi->close();
?>
