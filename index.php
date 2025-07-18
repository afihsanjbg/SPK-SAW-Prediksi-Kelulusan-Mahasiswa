<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="A'af Fatihul Ihsan">
    <link rel="icon" type="image/png" href="img/icon.png">
    <title>Kuesioner Data Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8;
        }

        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%233b82f6' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .gradient-overlay {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        .card-shadow {
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.1), 0 8px 10px -6px rgba(59, 130, 246, 0.1);
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .modal-animation {
            animation: modalFade 0.3s ease-out;
        }

        @keyframes modalFade {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .contact-card {
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-5px);
        }

        .social-icon {
            transition: all 0.2s ease;
        }

        .social-icon:hover {
            transform: scale(1.15);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span class="ml-2 text-lg font-semibold text-gray-800">SPK SAW</span>
                </div>
                <div class="flex items-center">
                    <a href="#" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">Beranda</a>
                    <!-- <a href="#" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">Tentang</a> -->
                    <a href="#" id="contactLink" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">Kontak</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-pattern min-h-screen flex items-center justify-center px-4 py-12">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-8 items-center">
            <!-- Left Column - Text Content -->
            <div class="space-y-6">
                <div class="inline-block px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-medium text-sm mb-2">
                    Sistem Pendukung Keputusan
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-800 leading-tight">
                    Informasi SPK SAW Prediksi Kelulusan Tepat Waktu
                </h1>
                <p class="text-base sm:text-lg text-gray-600">
                    Sistem ini menggunakan metode Simple Additive Weighting (SAW) untuk membantu memprediksi potensi kelulusan mahasiswa secara tepat waktu berdasarkan berbagai faktor akademik dan non-akademik. Data yang digunakan bersifat rahasia dan hanya untuk keperluan analisis penelitian.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 pt-4 w-full">
                    <button id="startBtn" class="pulse-animation px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-300 w-full sm:w-auto">
                        Prediksi Kelulusan Saya
                    </button>
                    <button id="infoBtn" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-300 w-full sm:w-auto">
                        Informasi Lebih Lanjut
                    </button>
                </div>
                <div class="pt-4 text-sm text-gray-500 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    Data Anda terlindungi dan hanya digunakan untuk keperluan penelitian
                </div>
            </div>

            <!-- Right Column - Illustration -->
            <div class="flex justify-center mt-10 md:mt-0">
                <div class="relative w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg">
                    <div class="absolute inset-0 bg-blue-500 rounded-full opacity-10 blur-3xl transform scale-110"></div>
                    <div class="relative bg-white p-6 rounded-xl card-shadow">
                        <div class="gradient-overlay rounded-lg p-6 text-white mb-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="font-semibold">Metode SAW</h3>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <p class="text-sm text-white leading-relaxed">
                                Metode Simple Additive Weighting (SAW) adalah salah satu teknik dalam Sistem Pendukung Keputusan yang digunakan untuk menentukan alternatif terbaik berdasarkan kriteria yang telah ditentukan.
                            </p>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="bg-blue-100 p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-800">Data Akademik</h4>
                                    <p class="text-xs text-gray-500">IPK, SKS, dan kehadiran</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="bg-blue-100 p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                        <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-800">Aktivitas Mahasiswa</h4>
                                    <p class="text-xs text-gray-500">Organisasi dan kegiatan</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="bg-blue-100 p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-800">Faktor Pendukung</h4>
                                    <p class="text-xs text-gray-500">Lingkungan dan motivasi</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-500">Metode yang digunakan</div>
                                <div class="text-sm font-medium text-blue-600">Simple Additive Weighting (SAW)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <!-- Modal for more information -->
    <div id="infoModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg max-w-md w-full p-6 m-4 modal-animation">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Informasi SPK SAW</h3>
                <button class="closeModal text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="space-y-4">
                <p class="text-gray-600">Sistem Pendukung Keputusan (SPK) ini menggunakan metode Simple Additive Weighting (SAW) untuk membantu memprediksi potensi kelulusan mahasiswa secara tepat waktu.</p>
                <p class="text-gray-600">SPK SAW menganalisis berbagai faktor akademik dan non-akademik, seperti IPK, SKS, kehadiran, serta aktivitas mahasiswa, untuk memberikan rekomendasi prediksi kelulusan.</p>
                <h4 class="font-medium text-gray-800 mt-4">Kerahasiaan Data</h4>
                <p class="text-gray-600">Semua data yang Anda berikan bersifat rahasia dan hanya digunakan untuk keperluan penelitian. Identitas responden tidak akan dipublikasikan dalam hasil penelitian.</p>
            </div>
            <div class="mt-6 flex justify-end">
                <button class="closeModal px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                    Mengerti
                </button>
            </div>
        </div>
    </div>

    <!-- Contact Modal -->
    <div id="contactModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl w-full max-w-3xl p-4 sm:p-6 m-2 sm:m-4 modal-animation
            overflow-y-auto max-h-[90vh]
            md:overflow-visible md:max-h-none">
            <div class="flex flex-row justify-between items-center mb-6">
                <h3 class="text-2xl font-semibold text-gray-800">Kontak Peneliti</h3>
                <button class="closeContactModal text-gray-400 hover:text-gray-600 ml-4 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <p class="text-gray-600 mb-6">Jika Anda memiliki pertanyaan atau membutuhkan informasi lebih lanjut tentang Sistem Pendukung Keputusan ini, silakan hubungi tim peneliti kami:</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <!-- Researcher 1 -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 sm:p-6 contact-card card-shadow">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-600 text-white p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-800">A'af Fatihul Ihsan</h4>
                            <p class="text-sm text-gray-500">Peneliti 1</p>
                        </div>
                    </div>

                    <div class="space-y-3 mb-5">
                        <div class="flex items-center">
                            <div class="w-8 text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                            </div>
                            <span class="text-gray-700">Telepon: <span class="font-medium">+62 822-6478-0932</span></span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-8 text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <span class="text-gray-700">Email: <span class="font-medium">aaffatihulihsan331@gmail.com</span></span>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        <p class="text-sm text-gray-600 mb-3">Media Sosial:</p>
                        <div class="flex space-x-3">
                            <!-- WhatsApp -->
                            <a href="https://wa.me/6282264780932" target="_self" class="social-icon bg-green-100 p-2 rounded-full text-green-600 hover:bg-green-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.52 3.48A11.93 11.93 0 0012 0C5.37 0 0 5.37 0 12c0 2.11.55 4.16 1.6 5.97L0 24l6.18-1.62A11.93 11.93 0 0012 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22c-1.85 0-3.67-.5-5.23-1.44l-.37-.22-3.67.96.98-3.58-.24-.37A9.93 9.93 0 012 12c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10 10zm5.27-7.73c-.29-.14-1.7-.84-1.96-.94-.26-.1-.45-.14-.64.14-.19.29-.74.94-.91 1.13-.17.19-.34.21-.63.07-.29-.14-1.22-.45-2.33-1.44-.86-.77-1.44-1.71-1.61-2-.17-.29-.02-.44.13-.58.13-.13.29-.34.43-.51.14-.17.19-.29.29-.48.1-.19.05-.36-.02-.51-.07-.14-.64-1.54-.88-2.11-.23-.56-.47-.48-.64-.49-.17-.01-.36-.01-.56-.01-.19 0-.5.07-.76.36-.26.29-1 1-1 2.44 0 1.44 1.03 2.84 1.17 3.04.14.19 2.03 3.1 4.92 4.23.69.3 1.23.48 1.65.62.69.22 1.32.19 1.82.12.56-.08 1.7-.7 1.94-1.38.24-.68.24-1.26.17-1.38-.07-.12-.26-.19-.55-.33z"/>
                                </svg>
                            </a>
                            <!-- LinkedIn -->
                            <a href="https://www.linkedin.com/in/afihsan/" target="_blank" class="social-icon bg-blue-100 p-2 rounded-full text-blue-600 hover:bg-blue-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
                            </a>
                            <!-- Instagram -->
                            <a href="https://www.instagram.com/aaf_ihsan/" target="_blank" class="social-icon bg-pink-100 p-2 rounded-full text-pink-600 hover:bg-pink-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Researcher 2 -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 sm:p-6 contact-card card-shadow">
                    <div class="flex items-center mb-4">
                        <div class="bg-indigo-600 text-white p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-800">M. Hafizh Syamsuddin</h4>
                            <p class="text-sm text-gray-500">Peneliti 2</p>
                        </div>
                    </div>

                    <div class="space-y-3 mb-5">
                        <div class="flex items-center">
                            <div class="w-8 text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                            </div>
                            <span class="text-gray-700">Telepon: <span class="font-medium">+62 859-1069-21090</span></span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-8 text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <span class="text-gray-700">Email: <span class="font-medium">daylight212223@gmail.com</span></span>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        <p class="text-sm text-gray-600 mb-3">Media Sosial:</p>
                        <div class="flex space-x-3">
                            <!-- WhatsApp -->
                            <a href="https://wa.me/62859106921090" target="_self" class="social-icon bg-green-100 p-2 rounded-full text-green-600 hover:bg-green-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.52 3.48A11.93 11.93 0 0012 0C5.37 0 0 5.37 0 12c0 2.11.55 4.16 1.6 5.97L0 24l6.18-1.62A11.93 11.93 0 0012 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22c-1.85 0-3.67-.5-5.23-1.44l-.37-.22-3.67.96.98-3.58-.24-.37A9.93 9.93 0 012 12c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10 10zm5.27-7.73c-.29-.14-1.7-.84-1.96-.94-.26-.1-.45-.14-.64.14-.19.29-.74.94-.91 1.13-.17.19-.34.21-.63.07-.29-.14-1.22-.45-2.33-1.44-.86-.77-1.44-1.71-1.61-2-.17-.29-.02-.44.13-.58.13-.13.29-.34.43-.51.14-.17.19-.29.29-.48.1-.19.05-.36-.02-.51-.07-.14-.64-1.54-.88-2.11-.23-.56-.47-.48-.64-.49-.17-.01-.36-.01-.56-.01-.19 0-.5.07-.76.36-.26.29-1 1-1 2.44 0 1.44 1.03 2.84 1.17 3.04.14.19 2.03 3.1 4.92 4.23.69.3 1.23.48 1.65.62.69.22 1.32.19 1.82.12.56-.08 1.7-.7 1.94-1.38.24-.68.24-1.26.17-1.38-.07-.12-.26-.19-.55-.33z"/>
                                </svg>
                            </a>
                            <!-- LinkedIn -->
                            <a href="javascript:void(0);" target="_self" class="social-icon bg-blue-100 p-2 rounded-full text-blue-600 hover:bg-blue-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
                            </a>
                            <!-- Instagram -->
                            <a href="javascript:void(0);" target="_self" class="social-icon bg-pink-100 p-2 rounded-full text-pink-600 hover:bg-pink-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">
                <p class="text-gray-600">Kami akan merespons pertanyaan Anda secepat mungkin.</p>
                <button class="closeContactModal mt-4 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        // Info Modal functionality
        const infoBtn = document.getElementById('infoBtn');
        const infoModal = document.getElementById('infoModal');
        const closeModalBtns = document.querySelectorAll('.closeModal');

        infoBtn.addEventListener('click', () => {
            infoModal.classList.remove('hidden');
        });

        closeModalBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                infoModal.classList.add('hidden');
            });
        });

        // Contact Modal functionality
        const contactLink = document.getElementById('contactLink');
        const contactModal = document.getElementById('contactModal');
        const closeContactModalBtns = document.querySelectorAll('.closeContactModal');

        contactLink.addEventListener('click', (e) => {
            e.preventDefault();
            contactModal.classList.remove('hidden');
        });

        closeContactModalBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                contactModal.classList.add('hidden');
            });
        });

        // Close modals when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === infoModal) {
                infoModal.classList.add('hidden');
            }
            if (e.target === contactModal) {
                contactModal.classList.add('hidden');
            }
        });

        // Start button functionality - would redirect to the actual form
        const startBtn = document.getElementById('startBtn');
        startBtn.addEventListener('click', () => {
            // alert('Mengarahkan ke halaman kuesioner...');
            // In a real implementation, this would redirect to the form page
            window.location.href = 'form.php';
        });
    </script>
    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement('script');
                    d.innerHTML = "window.__CF$cv$params={r:'9434f9c765165fa3',t:'MTc0NzgzOTk2NS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
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