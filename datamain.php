<?php
// password statis yang benar
$correct_password = "NasiPecelQuantum76";

// cek apakah password sudah dikirim via POST
if (isset($_POST['password'])) {
    if ($_POST['password'] === $correct_password) {
        $access_granted = true;
    } else {
        $error = "Password salah!";
    }
}

if (!isset($access_granted)) {
    // tampilkan form password kalau belum benar
    ?>
    <link rel="icon" type="image/png" href="img/icon.png">
    <title>Data Kuisioner</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <form method="POST" action="" class="bg-white p-6 md:p-8 rounded-lg shadow-lg w-full max-w-sm">
            <h2 class="text-2xl font-bold mb-4 text-center text-blue-700">Akses Data Kuisioner</h2>
            <label class="block text-gray-700 mb-2" for="password">Masukkan Password untuk akses:</label>
            <div class="relative mb-4">
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition text-base"
                    placeholder="Password" />
                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <i class="fas fa-lock"></i>
                </span>
            </div>
            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition text-base">
                Submit
            </button>
        </form>
    </div>
    <style>
        @media (max-width: 640px) {
            form.max-w-sm {
                max-width: 100% !important;
                padding: 1.5rem !important;
            }
            .min-h-screen {
                min-height: 100vh !important;
            }
        }
    </style>
    <?php
    if (isset($error)) {
        echo "
        <div class='fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40'>
            <div class='bg-white rounded-lg shadow-lg p-6 max-w-xs w-full text-center'>
                <div class='mb-4 text-red-600 text-2xl'>
                    <i class='fas fa-exclamation-triangle'></i>
                </div>
                <div class='mb-2 font-semibold text-lg'>Error</div>
                <div class='mb-4 text-gray-700'>$error</div>
                <button onclick=\"this.closest('.fixed').remove();\" class='mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition'>Tutup</button>
            </div>
        </div>
        <script>
            // Optional: close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if(e.key === 'Escape') {
                    var modal = document.querySelector('.fixed.inset-0');
                    if(modal) modal.remove();
                }
            });
        </script>
        ";
    }
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="A'af Fatihul Ihsan">
    <link rel="icon" type="image/png" href="img/icon.png">
    <title>Data Kuisioner</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8;
        }

        .table-container {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-radius: 0.5rem;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #3b82f6;
            color: white;
            font-weight: 600;
            text-align: left;
            padding: 1rem;
            position: sticky;
            top: 0;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        tr:nth-child(even) {
            background-color: #f9fafb;
        }

        tr:hover {
            background-color: #e5edff;
        }

        .pagination-btn {
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 0.375rem;
            background-color: #e5e7eb;
            color: #374151;
            font-weight: 500;
            transition: all 0.2s;
        }

        .pagination-btn:hover {
            background-color: #d1d5db;
        }

        .pagination-btn.active {
            background-color: #3b82f6;
            color: white;
        }

        .search-container {
            position: relative;
            width: 100%;
        }

        .search-input {
            width: 100%;
            padding: 0.5rem 0.75rem 0.5rem 2.5rem;
            border-radius: 0.375rem;
            border: 1px solid #d1d5db;
            font-size: 0.875rem;
            line-height: 1.25rem;
            color: #1f2937;
            background-color: #fff;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .search-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }

        .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }

            th,
            td {
                white-space: nowrap;
                padding: 0.75rem;
            }

            .card-view {
                display: flex;
                flex-direction: column;
                background-color: white;
                border-radius: 0.5rem;
                padding: 1rem;
                margin-bottom: 1rem;
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            }

            .card-view-item {
                display: flex;
                padding: 0.5rem 0;
                border-bottom: 1px solid #f3f4f6;
            }

            .card-view-label {
                font-weight: 500;
                width: 40%;
                color: #4b5563;
            }

            .card-view-value {
                width: 60%;
            }

            .pagination-btn-mobile .pagination-btn-text {
                display: none !important;
            }

            .pagination-btn-mobile .pagination-btn-icon {
                display: inline !important;
            }

            #studentTable {
                display: none;
            }
        }

        .badge {
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-green {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-yellow {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-red {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .badge-blue {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .badge-purple {
            background-color: #ede9fe;
            color: #5b21b6;
        }
    </style>
</head>

<body class="p-4 md:p-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Data Kuisioner</h1>
        <p class="text-gray-600 mb-6">Data Pengisian Kuisioner Mahasiswa untuk Prediksi Kelulusan Tepat Waktu</p>

        <div class="bg-white p-4 md:p-6 rounded-lg shadow-sm mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div class="w-full md:w-96">
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="searchInput" placeholder="Cari mahasiswa..." class="search-input">
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <label for="filterField" class="mr-2 text-gray-700">Filter:</label>
                    <select id="filterField" class="px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="all">Semua Kolom</option>
                        <option value="nama">Nama Lengkap</option>
                        <option value="nim">NIM</option>
                        <option value="prodi">Program Studi</option>
                        <option value="aktivitas">Aktivitas</option>
                        <option value="progres">Progres Skripsi</option>
                    </select>
                    <button id="exportCSV" class="ml-3 bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg transition flex items-center">
                        <i class="fas fa-file-excel"></i>
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <div class="table-container">
                    <table id="studentTable">
                        <thead>
                            <tr>
                                <th class="cursor-pointer" onclick="sortTable(0)">No <i class="fas fa-sort ml-1"></i></th>
                                <th class="cursor-pointer" onclick="sortTable(1)">Nama Lengkap <i class="fas fa-sort ml-1"></i></th>
                                <th class="cursor-pointer" onclick="sortTable(2)">NIM <i class="fas fa-sort ml-1"></i></th>
                                <th class="cursor-pointer" onclick="sortTable(3)">Program Studi <i class="fas fa-sort ml-1"></i></th>
                                <th class="cursor-pointer" onclick="sortTable(4)">Semester <i class="fas fa-sort ml-1"></i></th>
                                <th class="cursor-pointer" onclick="sortTable(5)">IPK <i class="fas fa-sort ml-1"></i></th>
                                <th class="cursor-pointer" onclick="sortTable(6)">SKS <i class="fas fa-sort ml-1"></i></th>
                                <th class="cursor-pointer" onclick="sortTable(7)">Kehadiran <i class="fas fa-sort ml-1"></i></th>
                                <th class="cursor-pointer" onclick="sortTable(8)">SP <i class="fas fa-sort ml-1"></i></th>
                                <th class="cursor-pointer" onclick="sortTable(9)">Aktivitas <i class="fas fa-sort ml-1"></i></th>
                                <th class="cursor-pointer" onclick="sortTable(10)">Progres Skripsi <i class="fas fa-sort ml-1"></i></th>
                                <th class="cursor-pointer" onclick="sortTable(11)">Prediksi Kelulusan (%) <i class="fas fa-sort ml-1"></i></th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <!-- Table data will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>

                <div id="mobileView" class="md:hidden mt-4">
                    <!-- Mobile cards will be populated by JavaScript -->
                </div>
            </div>

            <div class="mt-6 flex flex-col md:flex-row items-center justify-between">
                <div class="mb-4 md:mb-0">
                    <span class="text-gray-600">Menampilkan <span id="startIndex">1</span>-<span id="endIndex">10</span> dari <span id="totalItems">0</span> data</span>
                </div>

                <div class="flex items-center">
                    <button id="prevPage" class="pagination-btn pagination-btn-mobile">
                        <span class="pagination-btn-text"><i class="fas fa-chevron-left mr-1"></i> Sebelumnya</span>
                        <span class="pagination-btn-icon hidden"><i class="fas fa-chevron-left"></i></span>
                    </button>

                    <div id="paginationNumbers" class="flex">
                        <!-- Pagination numbers will be populated by JavaScript -->
                    </div>

                    <button id="nextPage" class="pagination-btn pagination-btn-mobile">
                        <span class="pagination-btn-text">Selanjutnya <i class="fas fa-chevron-right ml-1"></i></span>
                        <span class="pagination-btn-icon hidden"><i class="fas fa-chevron-right"></i></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample data with updated format
        let students = [];

        // Fetch data from getdata.php
        fetch('getdata.php')
            .then(response => response.json())
            .then(data => {
                // Untuk setiap data mahasiswa, hitung percentagePrediction dengan metode SAW
                students = data.map(student => {
                    // Konversi data numerik
                    const semester = parseInt(student.semester);
                    const ipk = parseFloat(student.ipk);
                    const sks = parseInt(student.sks);
                    const kehadiran = parseFloat(student.kehadiran);
                    const sp = parseInt(student.sp);

                    // Normalisasi nilai
                    const normalized = {
                        ipk: ipk / 4,
                        sks: sks / 144,
                        kehadiran: kehadiran / 100,
                        sp: sp > 0 ? Math.min(1, sp / 3) : 0,
                        aktivitas: (student.aktivitas === 'Tidak ada') ? 1 : 0.3,
                        progres: (student.progres === 'Ya, Bab 1–2') ? 0.4 : (student.progres === 'Ya, Bab 3–4') ? 0.7 : (student.progres === 'Ya, hampir selesai') ? 0.9 : 0.1
                    };

                    // Hitung prediksi persentase
                    const percentagePrediction = (
                        normalized.ipk * 0.3 +
                        normalized.sks * 0.25 +
                        normalized.kehadiran * 0.15 +
                        (1 - normalized.sp) * 0.1 +
                        normalized.aktivitas * 0.1 +
                        normalized.progres * 0.1
                    ) * 100;

                    // Tambahkan ke objek student
                    return {
                        ...student,
                        percentagePrediction: Math.round(percentagePrediction * 100) / 100 // 2 desimal
                    };
                });

                filteredStudents = [...students];
                updateTable();
                updatePagination();
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });


        // Pagination variables
        let currentPage = 1;
        const itemsPerPage = 10;
        let filteredStudents = [...students];

        // Initialize the table
        document.addEventListener('DOMContentLoaded', function() {
            updateTable();
            updatePagination();

            // Event listeners
            document.getElementById('searchInput').addEventListener('input', function() {
                filterTable();
            });

            document.getElementById('filterField').addEventListener('change', function() {
                filterTable();
            });

            document.getElementById('prevPage').addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    updateTable();
                    updatePagination();
                }
            });

            document.getElementById('nextPage').addEventListener('click', function() {
                const totalPages = Math.ceil(filteredStudents.length / itemsPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    updateTable();
                    updatePagination();
                }
            });
        });

        // Export to CSV
        document.getElementById('exportCSV').addEventListener('click', function() {
            // Prepare CSV header
            const headers = [
                'No', 'Nama Lengkap', 'NIM', 'Program Studi', 'Semester', 'IPK', 'SKS',
                'Kehadiran', 'SP', 'Aktivitas', 'Progres Skripsi', 'Prediksi Kelulusan (%)'
            ];
            let csvContent = headers.join(',') + '\n';

            // Prepare CSV rows from filteredStudents
            filteredStudents.forEach(student => {
                const row = [
                    student.no,
                    `"${student.nama.replace(/"/g, '""')}"`,
                    `"${student.nim.replace(/"/g, '""')}"`,
                    `"${student.prodi.replace(/"/g, '""')}"`,
                    student.semester,
                    student.ipk.toFixed(2),
                    student.sks,
                    student.kehadiran,
                    student.sp,
                    `"${student.aktivitas.replace(/"/g, '""')}"`,
                    `"${student.progres.replace(/"/g, '""')}"`,
                    student.percentagePrediction
                ];
                csvContent += row.join(',') + '\n';
            });

            // Create a Blob and trigger download
            const blob = new Blob([csvContent], {
                type: 'text/csv;charset=utf-8;'
            });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.download = 'data_kuisioner.csv';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            URL.revokeObjectURL(url);
        });

        // Filter table based on search input
        function filterTable() {
            const searchValue = document.getElementById('searchInput').value.toLowerCase();
            const filterField = document.getElementById('filterField').value;

            filteredStudents = students.filter(student => {
                if (searchValue === '') return true;

                switch (filterField) {
                    case 'nama':
                        return student.nama.toLowerCase().includes(searchValue);
                    case 'nim':
                        return student.nim.toLowerCase().includes(searchValue);
                    case 'prodi':
                        return student.prodi.toLowerCase().includes(searchValue);
                    case 'aktivitas':
                        return student.aktivitas.toLowerCase().includes(searchValue);
                    case 'progres':
                        return student.progres.toLowerCase().includes(searchValue);
                    case 'all':
                    default:
                        return (
                            student.nama.toLowerCase().includes(searchValue) ||
                            student.nim.toLowerCase().includes(searchValue) ||
                            student.prodi.toLowerCase().includes(searchValue) ||
                            student.aktivitas.toLowerCase().includes(searchValue) ||
                            student.progres.toLowerCase().includes(searchValue)
                        );
                }
            });

            currentPage = 1;
            updateTable();
            updatePagination();
        }

        // Update table with current data
        function updateTable() {
            const tableBody = document.getElementById('tableBody');
            const mobileView = document.getElementById('mobileView');
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = Math.min(startIndex + itemsPerPage, filteredStudents.length);

            // Update desktop table
            tableBody.innerHTML = '';
            for (let i = startIndex; i < endIndex; i++) {
                const student = filteredStudents[i];
                const row = document.createElement('tr');

                // Create badge for attendance
                let attendanceBadge = '';
                if (student.kehadiran >= 90) {
                    attendanceBadge = `<span class="badge badge-green">${student.kehadiran}%</span>`;
                } else if (student.kehadiran >= 80) {
                    attendanceBadge = `<span class="badge badge-yellow">${student.kehadiran}%</span>`;
                } else {
                    attendanceBadge = `<span class="badge badge-red">${student.kehadiran}%</span>`;
                }

                // Create badge for SP
                let spBadge = '';
                if (student.sp === 0) {
                    spBadge = `<span class="badge badge-green">${student.sp}</span>`;
                } else if (student.sp === 1) {
                    spBadge = `<span class="badge badge-yellow">${student.sp}</span>`;
                } else {
                    spBadge = `<span class="badge badge-red">${student.sp}</span>`;
                }

                // Create badge for activity
                let activityBadge = '';
                switch (student.aktivitas) {
                    case 'Organisasi Internal Kampus':
                        activityBadge = `<span class="badge badge-blue">${student.aktivitas}</span>`;
                        break;
                    case 'Organisasi Eksternal':
                        activityBadge = `<span class="badge badge-purple">${student.aktivitas}</span>`;
                        break;
                    case 'Perlombaan / Kompetisi Akademik':
                        activityBadge = `<span class="badge badge-green">${student.aktivitas}</span>`;
                        break;
                    case 'Kegiatan Relawan':
                        activityBadge = `<span class="badge badge-yellow">${student.aktivitas}</span>`;
                        break;
                    default:
                        activityBadge = `<span class="badge badge-blue">${student.aktivitas}</span>`;
                }

                // Create badge for thesis progress
                let progressBadge = '';
                switch (student.progres) {
                    case 'Ya, Bab 1–2':
                        progressBadge = `<span class="badge badge-yellow">${student.progres}</span>`;
                        break;
                    case 'Ya, Bab 3–4':
                        progressBadge = `<span class="badge badge-blue">${student.progres}</span>`;
                        break;
                    case 'Ya, hampir selesai':
                        progressBadge = `<span class="badge badge-green">${student.progres}</span>`;
                        break;
                    case 'Belum sama sekali':
                        progressBadge = `<span class="badge badge-red">${student.progres}</span>`;
                        break;
                    default:
                        progressBadge = `<span class="badge badge-red">${student.progres}</span>`;
                }

                // Create badge for percentagePrediction
                let predictionBadge = '';
                if (student.percentagePrediction >= 80) {
                    predictionBadge = `<span class="badge badge-green">${student.percentagePrediction}%</span>`;
                } else if (student.percentagePrediction >= 40) {
                    predictionBadge = `<span class="badge badge-yellow">${student.percentagePrediction}%</span>`;
                } else {
                    predictionBadge = `<span class="badge badge-red">${student.percentagePrediction}%</span>`;
                }

                row.innerHTML = `
                    <td>${student.no}</td>
                    <td class="font-medium">${student.nama}</td>
                    <td>${student.nim}</td>
                    <td>${student.prodi}</td>
                    <td>${student.semester}</td>
                    <td>${student.ipk.toFixed(2)}</td>
                    <td>${student.sks}</td>
                    <td>${attendanceBadge}</td>
                    <td>${spBadge}</td>
                    <td>${activityBadge}</td>
                    <td>${progressBadge}</td>
                    <td>${predictionBadge}</td>
                `;
                tableBody.appendChild(row);
            }

            // Update mobile view
            mobileView.innerHTML = '';
            for (let i = startIndex; i < endIndex; i++) {
                const student = filteredStudents[i];
                const card = document.createElement('div');
                card.className = 'card-view';

                // Create badge for attendance
                let attendanceBadge = '';
                if (student.kehadiran >= 90) {
                    attendanceBadge = `<span class="badge badge-green">${student.kehadiran}%</span>`;
                } else if (student.kehadiran >= 80) {
                    attendanceBadge = `<span class="badge badge-yellow">${student.kehadiran}%</span>`;
                } else {
                    attendanceBadge = `<span class="badge badge-red">${student.kehadiran}%</span>`;
                }

                // Create badge for SP
                let spBadge = '';
                if (student.sp === 0) {
                    spBadge = `<span class="badge badge-green">${student.sp}</span>`;
                } else if (student.sp === 1) {
                    spBadge = `<span class="badge badge-yellow">${student.sp}</span>`;
                } else {
                    spBadge = `<span class="badge badge-red">${student.sp}</span>`;
                }

                // Create badge for activity
                let activityBadge = '';
                switch (student.aktivitas) {
                    case 'Organisasi Internal Kampus':
                        activityBadge = `<span class="badge badge-blue">${student.aktivitas}</span>`;
                        break;
                    case 'Organisasi Eksternal':
                        activityBadge = `<span class="badge badge-purple">${student.aktivitas}</span>`;
                        break;
                    case 'Perlombaan / Kompetisi Akademik':
                        activityBadge = `<span class="badge badge-green">${student.aktivitas}</span>`;
                        break;
                    case 'Kegiatan Relawan':
                        activityBadge = `<span class="badge badge-yellow">${student.aktivitas}</span>`;
                        break;
                    default:
                        activityBadge = `<span class="badge badge-blue">${student.aktivitas}</span>`;
                }

                // Create badge for thesis progress
                let progressBadge = '';
                switch (student.progres) {
                    case 'Ya, Bab 1–2':
                        progressBadge = `<span class="badge badge-yellow">${student.progres}</span>`;
                        break;
                    case 'Ya, Bab 3–4':
                        progressBadge = `<span class="badge badge-blue">${student.progres}</span>`;
                        break;
                    case 'Ya, hampir selesai':
                        progressBadge = `<span class="badge badge-green">${student.progres}</span>`;
                        break;
                    case 'Belum sama sekali':
                        progressBadge = `<span class="badge badge-red">${student.progres}</span>`;
                        break;
                    default:
                        progressBadge = `<span class="badge badge-red">${student.progres}</span>`;
                }

                // Create badge for percentagePrediction
                let predictionBadge = '';
                if (student.percentagePrediction >= 80) {
                    predictionBadge = `<span class="badge badge-green">${student.percentagePrediction}%</span>`;
                } else if (student.percentagePrediction >= 40) {
                    predictionBadge = `<span class="badge badge-yellow">${student.percentagePrediction}%</span>`;
                } else {
                    predictionBadge = `<span class="badge badge-red">${student.percentagePrediction}%</span>`;
                }

                card.innerHTML = `
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="font-semibold text-lg">${student.nama}</h3>
                        <span class="text-sm text-gray-500">No. ${student.no}</span>
                    </div>
                    
                    <div class="card-view-item">
                        <div class="card-view-label">NIM</div>
                        <div class="card-view-value">${student.nim}</div>
                    </div>
                    
                    <div class="card-view-item">
                        <div class="card-view-label">Program Studi</div>
                        <div class="card-view-value">${student.prodi}</div>
                    </div>
                    
                    <div class="card-view-item">
                        <div class="card-view-label">Semester</div>
                        <div class="card-view-value">${student.semester}</div>
                    </div>
                    
                    <div class="card-view-item">
                        <div class="card-view-label">IPK</div>
                        <div class="card-view-value">${student.ipk.toFixed(2)}</div>
                    </div>
                    
                    <div class="card-view-item">
                        <div class="card-view-label">SKS</div>
                        <div class="card-view-value">${student.sks}</div>
                    </div>
                    
                    <div class="card-view-item">
                        <div class="card-view-label">Kehadiran</div>
                        <div class="card-view-value">${attendanceBadge}</div>
                    </div>
                    
                    <div class="card-view-item">
                        <div class="card-view-label">Jumlah SP</div>
                        <div class="card-view-value">${spBadge}</div>
                    </div>
                    
                    <div class="card-view-item">
                        <div class="card-view-label">Aktivitas</div>
                        <div class="card-view-value">${activityBadge}</div>
                    </div>
                    
                    <div class="card-view-item">
                        <div class="card-view-label">Progres Skripsi</div>
                        <div class="card-view-value">${progressBadge}</div>
                    </div>
                    <div class="card-view-item">
                        <div class="card-view-label">Prediksi Kelulusan (%)</div>
                        <div class="card-view-value">${predictionBadge}</div>
                    </div>
                `;

                mobileView.appendChild(card);
            }

            // Update display info
            document.getElementById('startIndex').textContent = filteredStudents.length > 0 ? startIndex + 1 : 0;
            document.getElementById('endIndex').textContent = endIndex;
            document.getElementById('totalItems').textContent = filteredStudents.length;
        }

        // Update pagination controls
        function updatePagination() {
            const paginationNumbers = document.getElementById('paginationNumbers');
            const totalPages = Math.ceil(filteredStudents.length / itemsPerPage);

            paginationNumbers.innerHTML = '';

            // Determine range of pages to show
            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(totalPages, startPage + 4);

            if (endPage - startPage < 4) {
                startPage = Math.max(1, endPage - 4);
            }

            // First page
            if (startPage > 1) {
                const pageBtn = createPageButton(1);
                paginationNumbers.appendChild(pageBtn);

                if (startPage > 2) {
                    const ellipsis = document.createElement('span');
                    ellipsis.className = 'px-2 py-1 text-gray-500';
                    ellipsis.textContent = '...';
                    paginationNumbers.appendChild(ellipsis);
                }
            }

            // Page numbers
            for (let i = startPage; i <= endPage; i++) {
                const pageBtn = createPageButton(i);
                paginationNumbers.appendChild(pageBtn);
            }

            // Last page
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    const ellipsis = document.createElement('span');
                    ellipsis.className = 'px-2 py-1 text-gray-500';
                    ellipsis.textContent = '...';
                    paginationNumbers.appendChild(ellipsis);
                }

                const pageBtn = createPageButton(totalPages);
                paginationNumbers.appendChild(pageBtn);
            }

            // Update button states
            document.getElementById('prevPage').disabled = currentPage === 1;
            document.getElementById('nextPage').disabled = currentPage === totalPages;

            if (currentPage === 1) {
                document.getElementById('prevPage').classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                document.getElementById('prevPage').classList.remove('opacity-50', 'cursor-not-allowed');
            }

            if (currentPage === totalPages || totalPages === 0) {
                document.getElementById('nextPage').classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                document.getElementById('nextPage').classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }

        // Create a page button for pagination
        function createPageButton(pageNum) {
            const pageBtn = document.createElement('button');
            pageBtn.className = `pagination-btn ${pageNum === currentPage ? 'active' : ''}`;
            pageBtn.textContent = pageNum;

            pageBtn.addEventListener('click', function() {
                currentPage = pageNum;
                updateTable();
                updatePagination();
            });

            return pageBtn;
        }

        // Sort table by column
        function sortTable(columnIndex) {
            const sortFields = ['no', 'nama', 'nim', 'prodi', 'semester', 'ipk', 'sks', 'kehadiran', 'sp', 'aktivitas', 'progres'];
            const field = sortFields[columnIndex];

            // Toggle sort direction
            const currentSortField = document.querySelector('th.sorted');
            let sortDirection = 'asc';

            if (currentSortField) {
                const currentField = Array.from(currentSortField.parentNode.children).indexOf(currentSortField);
                if (currentField === columnIndex) {
                    sortDirection = currentSortField.classList.contains('asc') ? 'desc' : 'asc';
                    currentSortField.classList.remove('asc', 'desc');
                } else {
                    currentSortField.classList.remove('sorted', 'asc', 'desc');
                }
            }

            // Sort the data
            filteredStudents.sort((a, b) => {
                let valueA = a[field];
                let valueB = b[field];

                if (typeof valueA === 'string') {
                    valueA = valueA.toLowerCase();
                    valueB = valueB.toLowerCase();
                }

                if (valueA < valueB) return sortDirection === 'asc' ? -1 : 1;
                if (valueA > valueB) return sortDirection === 'asc' ? 1 : -1;
                return 0;
            });

            // Update sort indicator
            const th = document.querySelectorAll('th')[columnIndex];
            th.classList.add('sorted', sortDirection);

            // Update icon
            const icon = th.querySelector('i');
            icon.className = sortDirection === 'asc' ? 'fas fa-sort-up ml-1' : 'fas fa-sort-down ml-1';

            // Update table
            updateTable();
        }
    </script>
    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement('script');
                    d.innerHTML = "window.__CF$cv$params={r:'9438706fa76af8fc',t:'MTc0Nzg3NjI4My4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                    b.getElementsByTagName('head')[0].appendChild(d)
                }
            }
            if (document.body) {
                var a = document.createElement('iframe');
                a.height = 1;
                a.width = 1;
                a.style.position = 'absolute';
                a.style.top = 0;
                a.style.left = 0;
                a.style.border = 'none';
                a.style.visibility = 'hidden';
                document.body.appendChild(a);
                if ('loading' !== document.readyState) c();
                else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
                else {
                    var e = document.onreadystatechange || function() {};
                    document.onreadystatechange = function(b) {
                        e(b);
                        'loading' !== document.readyState && (document.onreadystatechange = e, c())
                    }
                }
            }
        })();
    </script>
</body>

</html>