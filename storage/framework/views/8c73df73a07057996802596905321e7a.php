<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Antrean - Poliklinik Sehat</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 250px;
            background-color: #1a2332;
            color: #b0b8c6;
            display: flex;
            flex-direction: column;
            padding: 20px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
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
            background-color: #2d68c4;
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
            padding: 30px;
            overflow-y: auto;
            height: 100vh;
        }

        /* --- HEADER SECTION --- */
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .header-container h1 {
            font-size: 24px;
            color: #333;
        }

        .btn-tambah {
            background-color: #28a745; /* Hijau untuk Tambah Antrean */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-tambah:hover {
            background-color: #218838;
        }

        /* --- TWO COLUMN LAYOUT --- */
        .content-wrapper {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        /* --- LEFT COLUMN (QUEUE INFO) --- */
        .queue-info {
            flex: 1;
            min-width: 250px;
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .queue-label {
            font-size: 14px;
            color: #666;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .queue-number {
            font-size: 64px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        .patient-name {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .patient-detail {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        .btn-panggil {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            margin-top: 10px;
        }

        .btn-panggil:hover {
            background-color: #218838;
        }

        /* --- RIGHT COLUMN (TABLE LIST) --- */
        .queue-table-container {
            flex: 2;
            min-width: 400px;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 12px 15px;
            background-color: #f9fafb;
            color: #555;
            font-weight: 600;
            border-bottom: 1px solid #eee;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #f5f5f5;
            color: #333;
            font-size: 14px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        /* Status Badge */
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .status-diperiksa {
            background-color: #d4edda;
            color: #155724;
        }

        .status-menunggu {
            background-color: #fff3cd;
            color: #856404;
        }

        /* Action Button (Play) */
        .btn-play {
            background-color: #1a73e8;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-play:hover {
            background-color: #1557b0;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 15px;
            }
            .header-container {
                flex-direction: column;
                align-items: flex-start;
            }
            .content-wrapper {
                flex-direction: column;
            }
            .queue-info, .queue-table-container {
                width: 100%;
                min-width: 0;
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
            <li><a href="/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="/user"><i class="fas fa-user"></i> User</a></li>
            <li><a href="/jadwaldokter"><i class="fas fa-calendar-check"></i> Jadwal Dokter</a></li>
            <li><a href="/jadwalpasien"><i class="fas fa-calendar-alt"></i> Jadwal Pasien</a></li>
            <li><a href="/antrean" class="active"><i class="fas fa-clipboard-list"></i> Daftar Antrean</a></li>
            <li><a href="/riwayatpasien"><i class="fas fa-history"></i> Riwayat Pasien</a></li>
        </ul>

        <div class="logout">
            <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        
        <!-- HEADER & TOMBOL TAMBAH -->
        <div class="header-container">
            <h1>Daftar Antrean</h1>
            <div class="action-bar">
                <button class="btn-tambah"><i class="fas fa-plus"></i> Tambah Antrean</button>
            </div>
        </div>

        <!-- CONTENT WRAPPER (KIRI & KANAN) -->
        <div class="content-wrapper">
            
            <!-- KOLOM KIRI: INFO ANTREAN SAAT INI -->
            <div class="queue-info">
                <div class="queue-label">Nomor Antrean Sekarang</div>
                <div class="queue-number">002</div>
                <div class="patient-name">Siti Aminah</div>
                <div class="patient-detail">Poli Gigi - Dr. Sari Amelia</div>
                <button class="btn-panggil"><i class="fas fa-bullhorn"></i> Panggil Berikutnya</button>
            </div>

            <!-- KOLOM KANAN: DAFTAR ANTREAN -->
            <div class="queue-table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No. Antrean</th>
                            <th>Nama Pasien</th>
                            <th>Poli</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Baris 1 -->
                        <tr>
                            <td>001</td>
                            <td>Andi Saputra</td>
                            <td>Umum</td>
                            <td><span class="status-badge status-diperiksa">Diperiksa</span></td>
                            <td><button class="btn-play"><i class="fas fa-play"></i></button></td>
                        </tr>
                        <!-- Baris 2 -->
                        <tr>
                            <td>002</td>
                            <td>Siti Aminah</td>
                            <td>Gigi</td>
                            <td><span class="status-badge status-menunggu">Menunggu</span></td>
                            <td><button class="btn-play"><i class="fas fa-play"></i></button></td>
                        </tr>
                        <!-- Baris 3 -->
                        <tr>
                            <td>003</td>
                            <td>Budi Santoso</td>
                            <td>Anak</td>
                            <td><span class="status-badge status-menunggu">Menunggu</span></td>
                            <td><button class="btn-play"><i class="fas fa-play"></i></button></td>
                        </tr>
                        <!-- Baris 4 -->
                        <tr>
                            <td>004</td>
                            <td>Rina Amelia</td>
                            <td>Kandungan</td>
                            <td><span class="status-badge status-menunggu">Menunggu</span></td>
                            <td><button class="btn-play"><i class="fas fa-play"></i></button></td>
                        </tr>
                        <!-- Baris 5 -->
                        <tr>
                            <td>005</td>
                            <td>Dika Pratama</td>
                            <td>Umum</td>
                            <td><span class="status-badge status-menunggu">Menunggu</span></td>
                            <td><button class="btn-play"><i class="fas fa-play"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</body>
</html><?php /**PATH C:\poliklinik28\resources\views/antrean.blade.php ENDPATH**/ ?>