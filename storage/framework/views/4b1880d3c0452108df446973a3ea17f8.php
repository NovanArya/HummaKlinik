<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Poliklinik Sehat</title>
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js untuk Grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f3f6fd;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 250px;
            background-color: #1a2332; /* Warna biru tua sidebar */
            color: #b0b8c6;
            display: flex;
            flex-direction: column;
            padding: 20px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
        }

        .logo-area {
            display: flex;
            align-items: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 40px;
        }

        .logo-area i {
            font-size: 24px;
            margin-right: 10px;
            color: #4a90e2;
        }

        .nav-menu {
            list-style: none;
            flex-grow: 1;
        }

        .nav-menu li {
            margin-bottom: 5px;
        }

        .nav-menu a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #b0b8c6;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
            font-size: 14px;
        }

        .nav-menu a i {
            width: 25px;
            margin-right: 10px;
        }

        .nav-menu a:hover {
            background-color: #263446;
            color: white;
        }

        .nav-menu a.active {
            background-color: #2d68c4; /* Biru terang */
            color: white;
        }

        .logout {
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid #2c3e50;
        }

        .logout a {
            color: #b0b8c6;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
        }
        
        .logout a:hover {
            color: white;
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 20px 30px;
            overflow-y: auto;
            height: 100vh;
        }

        /* --- TOP HEADER --- */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 24px;
            color: #333;
        }

        .user-profile {
            display: flex;
            align-items: center;
        }

        .user-profile span {
            margin-right: 10px;
            color: #555;
            font-weight: 500;
        }

        .user-profile i {
            font-size: 30px;
            color: #888;
        }

        /* --- CARDS (STATISTICS) --- */
        .cards-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
        }

        .card-header {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
        }

        .card-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-size: 18px;
        }

        /* Warna ikon sesuai gambar */
        .icon-blue { background-color: #e3f2fd; color: #1976d2; }
        .icon-green { background-color: #e8f5e9; color: #388e3c; }
        .icon-purple { background-color: #f3e5f5; color: #7b1fa2; }
        .icon-red { background-color: #ffebee; color: #d32f2f; }

        .card h3 {
            font-size: 24px;
            color: #333;
            margin-bottom: 5px;
        }

        .card p {
            font-size: 14px;
            color: #666;
        }

        /* --- BOTTOM SECTION (CHART & TABLE) --- */
        .bottom-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            height: 400px;
        }

        .chart-container, .table-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }

        .chart-wrapper {
            flex-grow: 1;
            position: relative;
            height: 100%;
        }

        /* Tabel Antrian */
        .table-wrapper {
            flex-grow: 1;
            overflow-y: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            font-size: 13px;
            color: #666;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        td {
            padding: 12px 0;
            font-size: 14px;
            color: #333;
            border-bottom: 1px solid #f5f5f5;
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-menunggu {
            background-color: #fff3e0;
            color: #e65100;
        }

        .status-diperiksa {
            background-color: #e3f2fd;
            color: #1565c0;
        }

        .status-selesai {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .cards-container {
                grid-template-columns: 1fr 1fr;
            }
            .bottom-section {
                grid-template-columns: 1fr;
                height: auto;
            }
            .chart-container {
                height: 300px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none; /* Hide sidebar on mobile for simplicity */
            }
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            .cards-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo-area">
            <i class="fas fa-hospital-user"></i>
            <span>Poliklinik Sehat</span>
        </div>

        <ul class="nav-menu">
            <li><a href="/" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="/user"><i class="fas fa-user-md"></i> User</a></li>
            <li><a href="/jadwaldokter"><i class="fas fa-calendar-check"></i> Jadwal Dokter</a></li>
            <li><a href="/jadwalpasien"><i class="fas fa-calendar-alt"></i> Jadwal Pasien</a></li>
            <li><a href="/antrean"><i class="fas fa-clipboard-list"></i> Daftar Antrean</a></li>
            <li><a href="/riwayatpasien"><i class="fas fa-history"></i> Riwayat Pasien</a></li>
        </ul>

        <?php if(auth()->guard()->check()): ?>
            <div class="logout">
                <a href="<?php echo e(route('logout')); ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        <?php else: ?>
            <div class="logout">
                <a href="<?php echo e(route('login')); ?>"><i class="fas fa-sign-in-alt"></i> Login</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- HEADER -->
        <div class="header">
            <h1>Dashboard</h1>
            <div class="user-profile">
                <?php if(auth()->guard()->check()): ?>
                    <span>Halo, <?php echo e(Auth::user()->username ?? Auth::user()->name); ?></span>
                <?php endif; ?>
                <i class="fas fa-user-circle"></i>
            </div>
        </div>

        <!-- CARDS -->
        <div class="cards-container">
            <!-- Card 1: Dokter -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon icon-blue"><i class="fas fa-user-md"></i></div>
                </div>
                <h3>12</h3>
                <p>Dokter</p>
            </div>

            <!-- Card 2: Pasien -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon icon-green"><i class="fas fa-user-injured"></i></div>
                </div>
                <h3><?php echo e($totalPasien); ?></h3>
                <p>Pasien</p>
            </div>

            <!-- Card 3: Antrean Hari Ini -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon icon-purple"><i class="fas fa-chart-line"></i></div>
                </div>
                <h3><?php echo e($totalAntrean); ?></h3>
                <p>Antrean Hari Ini</p>
            </div>

            <!-- Card 4: Janji Hari Ini -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon icon-red"><i class="fas fa-calendar-day"></i></div>
                </div>
                <h3>8</h3>
                <p>Janji Hari Ini</p>
            </div>
        </div>

        <!-- BOTTOM SECTION: Chart & Table -->
        <div class="bottom-section">
            <!-- GRAFIK -->
            <div class="chart-container">
                <div class="section-title">Grafik Kunjungan (7 Hari Terakhir)</div>
                <div class="chart-wrapper">
                    <canvas id="visitChart"></canvas>
                </div>
            </div>

            <!-- TABEL ANTRIAN -->
            <div class="table-container">
                <div class="section-title">Antrean Terbaru</div>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>No. Antrean</th>
                                <th>Nama Pasien</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $antreens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $antrean): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e(str_pad($antrean->no_antrean, 3, '0', STR_PAD_LEFT)); ?></td>
                                    <td><?php echo e($antrean->nama_pasien); ?></td>
                                    <td><span class="status-badge status-<?php echo e($antrean->status); ?>"><?php echo e(ucfirst($antrean->status)); ?></span></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" style="text-align: center; padding: 20px; color: #999;">
                                        Tidak ada data antrean
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT CHART.JS -->
    <script>
        const ctx = document.getElementById('visitChart').getContext('2d');
        const visitChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'Jumlah Pasien',
                    data: [10, 18, 12, 8, 15, 6, 14],
                    borderColor: '#2d68c4',
                    backgroundColor: 'rgba(45, 104, 196, 0.1)',
                    borderWidth: 2,
                    tension: 0.3, // Membuat garis agak melengkung (smoothed)
                    pointRadius: 3,
                    pointBackgroundColor: '#2d68c4'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // Menyembunyikan legenda agar mirip gambar
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f0f0f0'
                        },
                        ticks: {
                            stepSize: 5
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>

</body>
</html><?php /**PATH C:\poliklinik28\resources\views/dashboard.blade.php ENDPATH**/ ?>