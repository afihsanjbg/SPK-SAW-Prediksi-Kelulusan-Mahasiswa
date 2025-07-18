<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="A'af Fatihul Ihsan">
    <link rel="icon" type="image/png" href="img/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuesioner Data Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8;
        }

        .form-container {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        .form-header {
            background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .btn-submit {
            background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }

        .progress-bar {
            transition: width 0.5s ease;
        }

        .question-section {
            transition: all 0.3s ease;
        }

        .checkbox-item:hover {
            background-color: #f0f7ff;
        }

        .radio-item:hover {
            background-color: #f0f7ff;
        }
    </style>
</head>

<body>
    <div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8 flex flex-col items-center justify-center">
        <div class="form-container w-full max-w-3xl rounded-xl overflow-hidden">
            <!-- Form Header -->
            <div class="form-header p-6 text-white">
                <h1 class="text-2xl font-bold">Formulir Data Mahasiswa untuk Sistem Pendukung Keputusan (SPK) SAW</h1>
                <p class="mt-2 opacity-90">Formulir ini digunakan untuk mengumpulkan data mahasiswa sebagai bagian dari proses pengambilan keputusan menggunakan metode Simple Additive Weighting (SAW). Data yang Anda berikan akan dijaga kerahasiaannya dan hanya digunakan untuk keperluan analisis SPK.</p>
            </div>

            <!-- Progress Bar -->
            <div class="bg-gray-100 h-2">
                <div id="progress-bar" class="progress-bar bg-indigo-500 h-2 w-0"></div>
            </div>

            <!-- Form Content -->
            <form id="student-form" class="p-6 bg-white" method="POST">
                <div id="form-sections">
                    <!-- Section 1: Basic Info -->
                    <div class="question-section" data-section="1">
                        <div class="mb-6">
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">1. Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" id="nama" name="nama" required class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Masukkan nama lengkap Anda">
                        </div>

                        <div class="mb-6">
                            <label for="nim" class="block text-sm font-medium text-gray-700 mb-1">2. NIM <span class="text-red-500">*</span></label>
                            <input type="text" id="nim" name="nim" pattern="\d{6,12}" required minlength="6" maxlength="12" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Contoh: 123456">
                            <p class="text-xs text-gray-500 mt-1">* Minimal 6 digit, Maksimal 12 digit</p>
                        </div>

                        <div class="mb-6">
                            <label for="prodi" class="block text-sm font-medium text-gray-700 mb-1">3. Program Studi <span class="text-red-500">*</span></label>
                            <select id="prodi" name="prodi" required class="w-full px-4 py-2 border border-gray-300 rounded-md">
                                <option value="" disabled selected>Pilih program studi</option>
                                <option value="Sistem Informasi">Sistem Informasi</option>
                                <option value="Teknik Informatika">Teknik Informatika</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            <div id="prodi-lainnya-container" class="mt-3 hidden">
                                <input type="text" id="prodi-lainnya" name="prodi-lainnya" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Sebutkan program studi Anda">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="semester" class="block text-sm font-medium text-gray-700 mb-1">4. Semester Saat Ini <span class="text-red-500">*</span></label>
                            <select id="semester" name="semester" required class="w-full px-4 py-2 border border-gray-300 rounded-md">
                                <option value="" disabled selected>Pilih semester</option>
                                <option value="1">Semester 1</option>
                                <option value="2">Semester 2</option>
                                <option value="3">Semester 3</option>
                                <option value="4">Semester 4</option>
                                <option value="5">Semester 5</option>
                                <option value="6">Semester 6</option>
                                <option value="7">Semester 7</option>
                                <option value="8">Semester 8</option>
                            </select>
                        </div>

                        <div class="flex justify-end">
                            <button type="button" class="next-btn btn-submit text-white px-6 py-2 rounded-md font-medium">Selanjutnya</button>
                        </div>
                    </div>

                    <!-- Section 2: Academic Info -->
                    <div class="question-section hidden" data-section="2">
                        <div class="mb-6">
                            <label for="ipk_now" class="block text-sm font-medium text-gray-700 mb-1">5. IPK Saat Ini <span class="text-red-500">*</span></label>
                            <input type="number" id="ipk_now" name="ipk_now" required step="0.01" min="0" max="4" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Contoh: 3.45">
                        </div>

                        <div class="mb-6">
                            <label for="jumlah_sks" class="block text-sm font-medium text-gray-700 mb-1">6. Jumlah SKS yang Telah Ditempuh <span class="text-red-500">*</span></label>
                            <input type="number" id="jumlah_sks" name="jumlah_sks" required min="0" max="999" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Contoh: 120">
                            <p class="text-xs text-gray-500 mt-1">* Jumlah SKS yang ditempuh dari Semester awal - Sekarang</p>
                        </div>

                        <div class="mb-6">
                            <label for="kehadiran" class="block text-sm font-medium text-gray-700 mb-1">7. Rata-rata Kehadiran Kuliah (%) <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="number" id="kehadiran" name="kehadiran" required min="0" max="100" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Contoh: 90">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <span class="text-gray-500">%</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="jumlah_sp" class="block text-sm font-medium text-gray-700 mb-1">8. Jumlah Mata Kuliah yang Pernah Diulang <span class="text-red-500">*</span></label>
                            <input type="number" id="jumlah_sp" name="jumlah_sp" required min="0" max="99" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Contoh: 2">
                        </div>

                        <div class="flex justify-between">
                            <button type="button" class="prev-btn px-6 py-2 bg-gray-200 rounded-md font-medium">Sebelumnya</button>
                            <button type="button" class="next-btn btn-submit text-white px-6 py-2 rounded-md font-medium">Selanjutnya</button>
                        </div>
                    </div>

                    <!-- Section 3: Additional Info -->
                    <div class="question-section hidden" data-section="3">
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">9. Aktivitas Non-Akademik yang Diikuti (Organisasi, Lomba, dll.) <span class="text-red-500">*</span></label>
                            <div class="space-y-2">
                                <div class="checkbox-item flex items-center p-2 rounded-md">
                                    <input type="checkbox" id="aktivitas-none" name="aktivitas" value="Tidak ada" class="h-5 w-5 text-indigo-600 rounded">
                                    <label for="aktivitas-none" class="ml-2 text-gray-700">Tidak ada</label>
                                </div>
                                <div class="checkbox-item flex items-center p-2 rounded-md">
                                    <input type="checkbox" id="aktivitas-internal" name="aktivitas" value="Organisasi Internal Kampus" class="h-5 w-5 text-indigo-600 rounded">
                                    <label for="aktivitas-internal" class="ml-2 text-gray-700">Organisasi Internal Kampus</label>
                                </div>
                                <div class="checkbox-item flex items-center p-2 rounded-md">
                                    <input type="checkbox" id="aktivitas-eksternal" name="aktivitas" value="Organisasi Eksternal" class="h-5 w-5 text-indigo-600 rounded">
                                    <label for="aktivitas-eksternal" class="ml-2 text-gray-700">Organisasi Eksternal</label>
                                </div>
                                <div class="checkbox-item flex items-center p-2 rounded-md">
                                    <input type="checkbox" id="aktivitas-lomba" name="aktivitas" value="Perlombaan / Kompetisi Akademik" class="h-5 w-5 text-indigo-600 rounded">
                                    <label for="aktivitas-lomba" class="ml-2 text-gray-700">Perlombaan / Kompetisi Akademik</label>
                                </div>
                                <div class="checkbox-item flex items-center p-2 rounded-md">
                                    <input type="checkbox" id="aktivitas-relawan" name="aktivitas" value="Kegiatan Relawan" class="h-5 w-5 text-indigo-600 rounded">
                                    <label for="aktivitas-relawan" class="ml-2 text-gray-700">Kegiatan Relawan</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">10. Apakah Anda Sudah Mulai Mengerjakan Skripsi? <span class="text-red-500">*</span></label>
                            <div class="space-y-2">
                                <div class="radio-item flex items-center p-2 rounded-md">
                                    <input type="radio" id="pgrs_ta-1-2" name="pgrs_ta" value="Bab 1-2" required class="h-5 w-5 text-indigo-600">
                                    <label for="pgrs_ta-1-2" class="ml-2 text-gray-700">Ya, Bab 1–2</label>
                                </div>
                                <div class="radio-item flex items-center p-2 rounded-md">
                                    <input type="radio" id="pgrs_ta-3-4" name="pgrs_ta" value="Bab 3-4" class="h-5 w-5 text-indigo-600">
                                    <label for="pgrs_ta-3-4" class="ml-2 text-gray-700">Ya, Bab 3–4</label>
                                </div>
                                <div class="radio-item flex items-center p-2 rounded-md">
                                    <input type="radio" id="pgrs_ta-selesai" name="pgrs_ta" value="Hampir Selesai" class="h-5 w-5 text-indigo-600">
                                    <label for="pgrs_ta-selesai" class="ml-2 text-gray-700">Ya, hampir selesai</label>
                                </div>
                                <div class="radio-item flex items-center p-2 rounded-md">
                                    <input type="radio" id="pgrs_ta-belum" name="pgrs_ta" value="Belum" class="h-5 w-5 text-indigo-600">
                                    <label for="pgrs_ta-belum" class="ml-2 text-gray-700">Belum sama sekali</label>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <button type="button" class="prev-btn px-6 py-2 bg-gray-200 rounded-md font-medium">Sebelumnya</button>
                            <button type="submit" class="btn-submit text-white px-6 py-2 rounded-md font-medium">Kirim</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Success Modal -->
        <div id="success-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="bg-white rounded-lg p-8 max-w-md w-full relative z-10">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                        <svg class="h-10 w-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">Terima Kasih!</h3>
                    <p class="text-gray-600 mb-6">Data Anda telah berhasil dikirim.</p>
                    <div class="flex justify-center">
                        <button id="close-modal" class="btn-submit text-white px-6 py-2 rounded-md font-medium">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Error Modal -->
        <div id="error-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="bg-white rounded-lg p-8 max-w-md w-full relative z-10">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                        <svg class="h-10 w-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">Terjadi Kesalahan</h3>
                    <p id="error-message" class="text-gray-600 mb-6">Ada kesalahan saat mengirim data.</p>
                    <div class="flex justify-center">
                        <button id="close-error-modal" class="btn-submit text-white px-6 py-2 rounded-md font-medium bg-red-500 hover:bg-red-600">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('student-form');
            const nimInput = document.getElementById('nim');
            const sections = document.querySelectorAll('.question-section');
            const progressBar = document.getElementById('progress-bar');
            const nextButtons = document.querySelectorAll('.next-btn');
            const prevButtons = document.querySelectorAll('.prev-btn');
            const successModal = document.getElementById('success-modal');
            const closeModalButton = document.getElementById('close-modal');
            const prodiSelect = document.getElementById('prodi');
            const prodiLainnyaContainer = document.getElementById('prodi-lainnya-container');
            const prodiLainnyaInput = document.getElementById('prodi-lainnya');
            const aktivitasNone = document.getElementById('aktivitas-none');
            const aktivitasCheckboxes = document.querySelectorAll('input[name="aktivitas"]');
            const errorModal = document.getElementById('error-modal');
            const errorMessage = document.getElementById('error-message');

            let currentSection = 1;
            const totalSections = sections.length;

            // Update progress bar
            function updateProgressBar() {
                const progress = ((currentSection - 1) / totalSections) * 100;
                progressBar.style.width = `${progress}%`;
            }

            // Show section
            function showSection(sectionNumber) {
                sections.forEach(section => {
                    section.classList.add('hidden');
                });
                document.querySelector(`[data-section="${sectionNumber}"]`).classList.remove('hidden');
                currentSection = sectionNumber;
                updateProgressBar();
            }

            // Next button click
            nextButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Validate current section
                    const currentSectionEl = document.querySelector(`[data-section="${currentSection}"]`);
                    const inputs = currentSectionEl.querySelectorAll('input[required], select[required]');
                    let isValid = true;

                    inputs.forEach(input => {
                        if (!input.checkValidity()) {
                            input.reportValidity();
                            isValid = false;
                        }
                    });

                    if (isValid) {
                        showSection(currentSection + 1);
                    }
                });
            });

            // Previous button click
            prevButtons.forEach(button => {
                button.addEventListener('click', function() {
                    showSection(currentSection - 1);
                });
            });

            // Handle "Program Studi" dropdown
            prodiSelect.addEventListener('change', function() {
                if (this.value === 'Lainnya') {
                    prodiLainnyaContainer.classList.remove('hidden');
                    document.getElementById('prodi-lainnya').setAttribute('required', '');
                } else {
                    prodiLainnyaContainer.classList.add('hidden');
                    document.getElementById('prodi-lainnya').removeAttribute('required');
                }
            });

            // Hanya boleh memilih satu aktivitas (checkbox jadi seperti radio)
            aktivitasCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        aktivitasCheckboxes.forEach(cb => {
                            if (cb !== this) cb.checked = false;
                        });
                    }
                });
            });

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const nimValue = nimInput.value.trim();
                if (!/^\d{6,12}$/.test(nimValue)) {
                    alert('NIM harus berupa angka dan terdiri dari 6 sampai 12 digit.');
                    nimInput.focus();
                    return;
                }

                // Buat FormData setelah validasi dan set prodi jika perlu
                const formData = new FormData(form);
                if (prodiSelect.value === 'Lainnya') {
                    const prodiLainnyaValue = prodiLainnyaInput.value.trim();
                    if (prodiLainnyaValue === '') {
                        alert('Silakan isi program studi Anda.');
                        return;
                    }
                    formData.set('prodi', prodiLainnyaValue);
                }

                (async () => {
                    try {
                        // Gunakan formData yang sudah di-set untuk kedua fetch
                        const response1 = await fetch('store_data.php', {
                            method: 'POST',
                            body: formData
                        });
                        const result = await response1.json();

                        if (result.status === 'success') {
                            await fetch('store_kuisioner.php', {
                                method: 'POST',
                                body: formData
                            });
                            // Apapun hasilnya, tetap redirect ke hitungsaw.php
                            window.location.href = 'hitungsaw.php';
                        } else {
                            errorMessage.textContent = result.message || 'Terjadi kesalahan saat mengirim data.';
                            errorModal.classList.remove('hidden');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        errorMessage.textContent = 'Terjadi kesalahan koneksi. Silakan coba lagi.';
                        errorModal.classList.remove('hidden');
                    }
                })();
            });

            // Close error modal
            document.getElementById('close-error-modal').addEventListener('click', function() {
                errorModal.classList.add('hidden');
            });

            // Close modal
            closeModalButton.addEventListener('click', function() {
                successModal.classList.add('hidden');
                form.reset();
                window.location.href = 'thanks.php';
            });

            // Initialize
            updateProgressBar();
        });
    </script>
    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement('script');
                    d.innerHTML = "window.__CF$cv$params={r:'9431820cc131d4de',t:'MTc0NzgwMzYwNC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
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