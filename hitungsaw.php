<?php
session_start();

function clean_input($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}

if (!isset($_SESSION['student_data'])) {
    die("Data mahasiswa tidak tersedia. Silakan isi formulir terlebih dahulu.");
}

$studentData = array_map('clean_input', $_SESSION['student_data']);

// Optional: Hapus session setelah dibaca agar tidak bisa diakses ulang
unset($_SESSION['student_data']);

// Konversi data numerik
$studentData['semester'] = (int)$studentData['semester'];
$studentData['ipk_now'] = (float)$studentData['ipk_now'];
$studentData['jumlah_sks'] = (int)$studentData['jumlah_sks'];
$studentData['kehadiran'] = (float)$studentData['kehadiran'];
$studentData['jumlah_sp'] = (int)$studentData['jumlah_sp'];

if (!isset($normalizedValues)) {
    $normalizedValues = [
        'ipk_now' => $studentData['ipk_now'] / 4,
        'jumlah_sks' => $studentData['jumlah_sks'] / 144,
        'kehadiran' => $studentData['kehadiran'] / 100,
        'jumlah_sp' => ($studentData['jumlah_sp'] > 0) ? min(1, $studentData['jumlah_sp'] / 3) : 0,
        'aktivitas' => ($studentData['aktivitas'] == 'Tidak ada') ? 1 : 0.3,
        'pgrs_ta' => ($studentData['pgrs_ta'] == 'Bab 1-2') ? 0.4 : (($studentData['pgrs_ta'] == 'Bab 3-4') ? 0.7 : (($studentData['pgrs_ta'] == 'Hampir Selesai') ? 0.9 : 0.1))
    ];
}

$predictionPercentage = (
    $normalizedValues['ipk_now'] * 0.3 +
    $normalizedValues['jumlah_sks'] * 0.25 +
    $normalizedValues['kehadiran'] * 0.15 +
    (1 - $normalizedValues['jumlah_sp']) * 0.1 +
    $normalizedValues['aktivitas'] * 0.1 + // Sudah sebagai cost
    $normalizedValues['pgrs_ta'] * 0.1
) * 100;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="A'af Fatihul Ihsan">
    <link rel="icon" type="image/png" href="img/icon.png">
    <title>Hasil Prediksi - Kuesioner Data Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            min-height: 100vh;
        }

        .progress-bar {
            height: 10px;
            border-radius: 5px;
            background-color: #e0e0e0;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 5px;
            transition: width 0.5s ease;
        }

        .criteria-card {
            transition: all 0.3s ease;
        }

        .criteria-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .result-card {
            animation: card-appear 0.8s ease-out forwards;
            transform: translateY(30px);
            opacity: 0;
        }

        @keyframes card-appear {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container mx-auto px-4 py-12">
        <div class="result-card bg-white rounded-2xl shadow-xl p-8 max-w-6xl w-full mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Hasil Prediksi Kelulusan</h1>
                    <p class="text-gray-600">Metode SAW (Simple Additive Weighting)</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span class="inline-block px-4 py-2 rounded-full text-white font-medium 
                        <?php
                        // Warna berdasarkan hasil prediksi
                        if ($predictionPercentage >= 70) {
                            echo 'bg-green-500';
                        } elseif ($predictionPercentage >= 40) {
                            echo 'bg-yellow-500';
                        } else {
                            echo 'bg-red-500';
                        }
                        ?>">
                        <?php
                        if ($predictionPercentage >= 70) {
                            echo 'Tinggi';
                        } elseif ($predictionPercentage >= 40) {
                            echo 'Sedang';
                        } else {
                            echo 'Rendah';
                        }
                        ?>
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Bagian Kiri: Informasi Mahasiswa -->
                <div>
                    <div class="bg-blue-50 rounded-xl p-6 mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Informasi Mahasiswa</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Nama</span>
                                <span class="font-medium"><?php echo htmlspecialchars($studentData['nama']); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">NIM</span>
                                <span class="font-medium"><?php echo htmlspecialchars($studentData['nim']); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Program Studi</span>
                                <span class="font-medium"><?php echo htmlspecialchars($studentData['prodi']); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Semester</span>
                                <span class="font-medium"><?php echo htmlspecialchars($studentData['semester']); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Grafik Radar -->
                    <div class="bg-white rounded-xl p-6 border border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Profil Akademik</h3>
                        <canvas id="radarChart" height="300"></canvas>
                    </div>
                </div>

                <!-- Bagian Kanan: Hasil Prediksi -->
                <div>
                    <div class="bg-white rounded-xl p-6 border border-gray-200 mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Hasil Prediksi</h3>
                        <div class="mb-4">
                            <div class="flex justify-between mb-1">
                                <span class="font-medium">Potensi Kelulusan Tepat Waktu</span>
                                <span class="font-bold"><?php echo round($predictionPercentage); ?>%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill 
                                    <?php
                                    if ($predictionPercentage >= 80) {
                                        echo 'bg-green-500';
                                    } elseif ($predictionPercentage >= 40) {
                                        echo 'bg-yellow-500';
                                    } else {
                                        echo 'bg-red-500';
                                    }
                                    ?>" style="width: <?php echo $predictionPercentage; ?>%">
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h4 class="font-medium text-gray-700 mb-3">Interpretasi Hasil:</h4>
                            <?php if ($predictionPercentage >= 80): ?>
                                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r">
                                    <p class="text-green-700">Potensi kelulusan tepat waktu Anda <strong>tinggi</strong>. Dengan menjaga konsistensi dan menyelesaikan skripsi sesuai rencana, Anda memiliki peluang besar untuk lulus tepat waktu.</p>
                                </div>
                            <?php elseif ($predictionPercentage >= 40): ?>
                                <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-r">
                                    <p class="text-yellow-700">Potensi kelulusan tepat waktu Anda <strong>sedang</strong>. Beberapa aspek perlu diperbaiki seperti meningkatkan IPK, kehadiran, atau percepatan penyelesaian skripsi.</p>
                                    <p class="text-yellow-700">Perhatikan keseimbangan antara aktivitas akademik dan non-akademik. Terlalu banyak kegiatan di luar kuliah bisa mengganggu fokus studi.</p>
                                </div>
                            <?php else: ?>
                                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r">
                                    <p class="text-red-700">Potensi kelulusan tepat waktu Anda <strong>rendah</strong>. Disarankan untuk berkonsultasi dengan dosen pembimbing akademik untuk membuat rencana percepatan.</p>
                                    <p class="text-red-700">Perhatikan keseimbangan antara aktivitas akademik dan non-akademik. Terlalu banyak kegiatan di luar kuliah bisa mengganggu fokus studi.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Rekomendasi -->
                    <div class="bg-white rounded-xl p-6 border border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Rekomendasi</h3>
                        <ul class="space-y-3">
                            <?php
                            // Rekomendasi berdasarkan analisis kriteria
                            $recommendations = [];

                            // 1. Rekomendasi IPK
                            if ($normalizedValues['ipk_now'] < 0.6) {
                                $recommendations[] = "Prioritaskan peningkatan IPK dengan: (1) Fokus pada mata kuliah bobot SKS tinggi, (2) Manfaatkan jam konsultasi dosen, (3) Bentuk kelompok belajar.";
                            } elseif ($normalizedValues['ipk_now'] < 0.8) {
                                $recommendations[] = "Pertahankan IPK Anda. Untuk meningkatkannya: (1) Perbanyak latihan soal, (2) Tingkatkan partisipasi di kelas, (3) Manfaatkan sumber belajar tambahan.";
                            }

                            // 2. Rekomendasi SKS
                            if ($normalizedValues['jumlah_sks'] < 0.7) {
                                if ($studentData['semester'] >= 5) {
                                    $recommendations[] = "Anda tertinggal dalam pengambilan SKS. Segera buat rencana percepatan dengan: (1) Ambil mata kuliah musim pendek, (2) Konsultasi dengan pembimbing akademik, (3) Pertimbangkan beban SKS lebih tinggi semester depan.";
                                } else {
                                    $recommendations[] = "Pantau progres SKS Anda secara berkala untuk memastikan tetap sesuai rencana studi.";
                                }
                            }

                            // 3. Rekomendasi Kehadiran
                            if ($normalizedValues['kehadiran'] < 0.8) {
                                $recommendations[] = "Tingkatkan kehadiran perkuliahan minimal 85% dengan: (1) Buat jadwal harian, (2) Aktifkan pengingat, (3) Manfaatkan sistem absensi online.";
                            }

                            // 4. Rekomendasi Mata Kuliah Diulang
                            if ($normalizedValues['jumlah_sp'] > 0.3) {
                                $recommendations[] = "Hindari pengulangan mata kuliah dengan: (1) Evaluasi penyebab ketidaklulusan, (2) Ikut program tutor sebaya, (3) Manfaatkan fasilitas remedial.";
                            }

                            // 5. Rekomendasi Aktivitas Non-Akademik (Pendekatan Cost)
                            if ($studentData['aktivitas'] != 'Tidak ada') {
                                if ($normalizedValues['ipk_now'] < 0.7 || $studentData['jumlah_sp'] > 0) {
                                    $recommendations[] = "Evaluasi komitmen organisasi Anda. Pertimbangkan: (1) Skala prioritas kegiatan, (2) Alokasi waktu khusus belajar, (3) Delegasi tugas organisasi.";
                                } elseif ($studentData['semester'] >= 6) {
                                    $recommendations[] = "Di semester akhir, fokus utama pada penyelesaian studi. Kurangi intensitas organisasi jika diperlukan.";
                                }
                            } else {
                                if ($normalizedValues['ipk_now'] >= 0.8 && $studentData['semester'] <= 5 && $studentData['jumlah_sp'] == 0) {
                                    $recommendations[] = "Pertimbangkan satu kegiatan pengembangan diri untuk melengkapi kompetensi, dengan tetap mempertahankan IPK.";
                                }
                            }

                            // 6. Rekomendasi Skripsi
                            if ($studentData['semester'] >= 6) {
                                if ($normalizedValues['pgrs_ta'] < 0.3) {
                                    $recommendations[] = "Segera mulai skripsi dengan: (1) Temui pembimbing mingguan, (2) Buat timeline realistis, (3) Ikut workshop metodologi penelitian.";
                                } elseif ($normalizedValues['pgrs_ta'] < 0.6) {
                                    $recommendations[] = "Percepat progres skripsi dengan: (1) Fokus pada bab yang tertinggal, (2) Manfaatkan layanan konsultasi perpustakaan, (3) Ikut kelompok penulisan skripsi.";
                                }
                            }

                            // Rekomendasi tambahan berdasarkan kombinasi kriteria
                            if ($normalizedValues['ipk_now'] < 0.7 && $normalizedValues['kehadiran'] < 0.7) {
                                $recommendations[] = "IPK dan kehadiran rendah menunjukkan masalah konsistensi. Evaluasi: (1) Gaya belajar, (2) Manajemen waktu, (3) Kesehatan fisik/mental.";
                            }

                            if ($studentData['semester'] >= 7 && $normalizedValues['jumlah_sks'] < 0.8) {
                                $recommendations[] = "Masa studi sudah lanjut namun SKS masih tertinggal. Segera konsultasikan opsi percepatan dengan departemen akademik.";
                            }

                            // Jika tidak ada rekomendasi spesifik
                            if (empty($recommendations)) {
                                $recommendations[] = "Pertahankan performa akademik Anda. Lanjutkan dengan: (1) Evaluasi berkala, (2) Perbaikan berkelanjutan, (3) Konsultasi rutin dengan pembimbing.";
                            }

                            // Tampilkan rekomendasi
                            foreach ($recommendations as $rec) {
                                echo '<li class="flex items-start mb-3 bg-gray-50 p-3 rounded-lg">
                                        <svg class="h-5 w-5 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-gray-700">' . htmlspecialchars($rec) . '</span>
                                    </li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Detail Kriteria -->
            <div class="mt-10">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Detail Penilaian Kriteria</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Kriteria 1: IPK -->
                    <div class="criteria-card bg-white rounded-xl p-6 border border-gray-200 hover:shadow-md">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-bold text-lg text-gray-800">IPK Saat Ini</h4>
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Bobot: 30%</span>
                        </div>
                        <div class="mb-2">
                            <div class="flex justify-between text-sm mb-1">
                                <span>Nilai</span>
                                <span><?php echo $studentData['ipk_now']; ?></span>
                            </div>
                            <div class="progress-bar bg-gray-200">
                                <div class="progress-fill bg-blue-500" style="width: <?php echo ($studentData['ipk_now'] / 4) * 100; ?>%"></div>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Semakin tinggi IPK, semakin baik potensi kelulusan tepat waktu.</p>
                    </div>

                    <!-- Kriteria 2: SKS -->
                    <div class="criteria-card bg-white rounded-xl p-6 border border-gray-200 hover:shadow-md">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-bold text-lg text-gray-800">SKS Ditempuh</h4>
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Bobot: 25%</span>
                        </div>
                        <div class="mb-2">
                            <div class="flex justify-between text-sm mb-1">
                                <span>Nilai</span>
                                <span><?php echo $studentData['jumlah_sks']; ?> SKS</span>
                            </div>
                            <div class="progress-bar bg-gray-200">
                                <div class="progress-fill bg-blue-500" style="width: <?php echo ($studentData['jumlah_sks'] / 144) * 100; ?>%"></div>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">SKS yang telah ditempuh dibandingkan dengan target kelulusan (144 SKS).</p>
                    </div>

                    <!-- Kriteria 3: Kehadiran -->
                    <div class="criteria-card bg-white rounded-xl p-6 border border-gray-200 hover:shadow-md">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-bold text-lg text-gray-800">Kehadiran</h4>
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Bobot: 15%</span>
                        </div>
                        <div class="mb-2">
                            <div class="flex justify-between text-sm mb-1">
                                <span>Nilai</span>
                                <span><?php echo $studentData['kehadiran']; ?>%</span>
                            </div>
                            <div class="progress-bar bg-gray-200">
                                <div class="progress-fill bg-blue-500" style="width: <?php echo $studentData['kehadiran']; ?>%"></div>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Rata-rata kehadiran perkuliahan dalam persentase.</p>
                    </div>

                    <!-- Kriteria 4: MK Diulang -->
                    <div class="criteria-card bg-white rounded-xl p-6 border border-gray-200 hover:shadow-md">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-bold text-lg text-gray-800">MK Diulang</h4>
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Bobot: 10%</span>
                        </div>
                        <div class="mb-2">
                            <div class="flex justify-between text-sm mb-1">
                                <span>Nilai</span>
                                <span><?php echo $studentData['jumlah_sp']; ?> MK</span>
                            </div>
                            <div class="progress-bar bg-gray-200">
                                <div class="progress-fill bg-blue-500" style="width: <?php echo max(0, 100 - ($studentData['jumlah_sp'] * 20)); ?>%"></div>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Semakin sedikit mata kuliah yang diulang, semakin baik.</p>
                    </div>

                    <!-- Kriteria 5: Aktivitas -->
                    <div class="criteria-card bg-white rounded-xl p-6 border border-gray-200 hover:shadow-md">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-bold text-lg text-gray-800">Aktivitas</h4>
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Bobot: 10%</span>
                        </div>
                        <div class="mb-2">
                            <div class="flex justify-between text-sm mb-1">
                                <span>Nilai</span>
                                <span><?php echo ($studentData['aktivitas'] != 'Tidak ada') ? 'Aktif' : 'Tidak Aktif'; ?></span>
                            </div>
                            <div class="progress-bar bg-gray-200">
                                <div class="progress-fill bg-blue-500" style="width: <?php echo ($studentData['aktivitas'] != 'Tidak ada') ? 100 : 30; ?>%"></div>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Partisipasi dalam kegiatan non-akademik perlu diimbangi dengan manajemen waktu yang baik.</p>
                    </div>

                    <!-- Kriteria 6: Skripsi -->
                    <div class="criteria-card bg-white rounded-xl p-6 border border-gray-200 hover:shadow-md">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-bold text-lg text-gray-800">Progres Skripsi</h4>
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Bobot: 10%</span>
                        </div>
                        <div class="mb-2">
                            <div class="flex justify-between text-sm mb-1">
                                <span>Nilai</span>
                                <span><?php echo htmlspecialchars($studentData['pgrs_ta']); ?></span>
                            </div>
                            <div class="progress-bar bg-gray-200">
                                <div class="progress-fill bg-blue-500" style="width: <?php
                                                                                        $progress = 0;
                                                                                        if ($studentData['pgrs_ta'] == 'Bab 1-2') $progress = 40;
                                                                                        elseif ($studentData['pgrs_ta'] == 'Bab 3-4') $progress = 70;
                                                                                        elseif ($studentData['pgrs_ta'] == 'Hampir Selesai') $progress = 90;
                                                                                        echo $progress;
                                                                                        ?>%"></div>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Tingkat penyelesaian tugas akhir/skripsi.</p>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
                <a href="index.php" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg text-center transition duration-300">
                    Kembali ke Beranda
                </a>
                <button id="shareButton" class="bg-white border border-blue-600 text-blue-600 hover:bg-blue-50 font-medium py-3 px-6 rounded-lg text-center transition duration-300">
                    Bagikan
                </button>
            </div>
        </div>
    </div>

    <script>
        // Data untuk chart
        const radarData = {
            labels: ['IPK', 'SKS', 'Kehadiran', 'MK Diulang', 'Aktivitas', 'Skripsi'],
            datasets: [{
                label: 'Profil Akademik Anda',
                data: [
                    <?php echo $studentData['ipk_now']; ?>,
                    <?php echo ($studentData['jumlah_sks'] / 144) * 4; ?>,
                    <?php echo ($studentData['kehadiran'] / 100) * 4; ?>,
                    <?php echo max(0, 4 - ($studentData['jumlah_sp'] * 0.8)); ?>,
                    <?php echo ($studentData['aktivitas'] != 'Tidak ada') ? 1.5 : 3.5; ?>,
                    <?php
                    $skripsiScore = 1;
                    if ($studentData['pgrs_ta'] == 'Bab 1-2') $skripsiScore = 2;
                    elseif ($studentData['pgrs_ta'] == 'Bab 3-4') $skripsiScore = 3;
                    elseif ($studentData['pgrs_ta'] == 'Hampir Selesai') $skripsiScore = 4;
                    echo $skripsiScore;
                    ?>
                ],
                backgroundColor: 'rgba(79, 70, 229, 0.2)',
                borderColor: 'rgba(79, 70, 229, 1)',
                borderWidth: 2,
                pointBackgroundColor: 'rgba(79, 70, 229, 1)',
                pointRadius: 4
            }, {
                label: 'Rata-rata Ideal',
                data: [3.5, 3.5, 3.5, 3.5, 2.5, 3.5], // Nilai ideal aktivitas di tengah (2.5)
                backgroundColor: 'rgba(156, 163, 175, 0.1)',
                borderColor: 'rgba(156, 163, 175, 1)',
                borderWidth: 1,
                borderDash: [5, 5],
                pointRadius: 0
            }]
        };

        const radarConfig = {
            type: 'radar',
            data: radarData,
            options: {
                scales: {
                    r: {
                        angleLines: {
                            display: true
                        },
                        suggestedMin: 0,
                        suggestedMax: 4,
                        ticks: {
                            stepSize: 1,
                            backdropColor: 'transparent'
                        }
                    }
                },
                elements: {
                    line: {
                        tension: 0.1
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                const index = context.dataIndex;
                                const value = context.raw;

                                switch (index) {
                                    case 0: // IPK
                                        return label + value.toFixed(2) + ' (IPK)';
                                    case 1: // SKS
                                        const sksValue = Math.round((value / 4) * 144);
                                        return label + sksValue + ' SKS';
                                    case 2: // Kehadiran
                                        const presenceValue = Math.round((value / 4) * 100);
                                        return label + presenceValue + '%';
                                    case 3: // MK Diulang
                                        const repeatValue = Math.round((4 - value) / 0.8);
                                        return label + repeatValue + ' MK';
                                    case 4: // Aktivitas
                                        return label + (value > 2 ? 'Tidak Aktif (Optimal)' : 'Aktif (Perlu Evaluasi)');
                                    case 5: // Skripsi
                                        let skripsiText = '';
                                        if (value < 1.5) skripsiText = 'Belum';
                                        else if (value < 2.5) skripsiText = 'Bab 1-2';
                                        else if (value < 3.5) skripsiText = 'Bab 3-4';
                                        else skripsiText = 'Hampir Selesai';
                                        return label + skripsiText;
                                    default:
                                        return label + value;
                                }
                            }
                        }
                    }
                }
            }
        };

        // Render chart
        window.addEventListener('load', function() {
            const radarCtx = document.getElementById('radarChart').getContext('2d');
            new Chart(radarCtx, radarConfig);
        });

        if (performance.navigation.type === 1) {
            window.location.href = 'index.php';
        }

        // Share button functionality
        document.getElementById('shareButton').addEventListener('click', function() {
            if (navigator.share) {
                navigator.share({
                        title: 'Kuesioner Data Mahasiswa untuk Prediksi Kelulusan Tepat Waktu',
                        text: 'Bantu penelitian dengan mengisi kuesioner ini!',
                        url: window.location.href
                    })
                    .catch((error) => console.log('Error sharing:', error));
            } else {
                alert('Fitur berbagi tidak tersedia di browser Anda. Silakan salin URL halaman ini untuk membagikan.');
            }
        });
    </script>
</body>

</html>