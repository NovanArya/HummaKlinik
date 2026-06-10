<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pasien - Poliklinik Sehat</title>
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

        .search-box {
            position: relative;
        }

        .search-box input {
            padding: 8px 15px 8px 35px;
            border: 1px solid #ddd;
            border-radius: 20px;
            width: 250px;
            font-size: 14px;
            outline: none;
            transition: border 0.3s;
        }

        .search-box input:focus {
            border-color: #1a73e8;
        }

        .search-box i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        /* --- TWO COLUMN LAYOUT --- */
        .content-wrapper {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        /* --- LEFT COLUMN (PROFILE) --- */
        .profile-card {
            flex: 1;
            min-width: 250px;
            max-width: 350px;
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .avatar {
            width: 60px;
            height: 60px;
            background-color: #e3f2fd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1a73e8;
            font-size: 30px;
        }

        .profile-name {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .profile-details {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            border-bottom: 1px solid #f5f5f5;
            padding-bottom: 8px;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #666;
        }

        .detail-value {
            color: #333;
            font-weight: 500;
        }

        /* --- RIGHT COLUMN (MEDICAL HISTORY TABLE) --- */
        .history-table-container {
            flex: 3;
            min-width: 400px;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        th {
            text-align: left;
            padding: 12px 15px;
            background-color: #f9fafb;
            color: #555;
            font-weight: 600;
            border-bottom: 1px solid #eee;
            font-size: 13px;
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
            .search-box {
                width: 100%;
            }
            .search-box input {
                width: 100%;
            }
            .content-wrapper {
                flex-direction: column;
            }
            .profile-card {
                max-width: 100%;
            }
            .history-table-container {
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
            <li><a href="/antrean"><i class="fas fa-clipboard-list"></i> Daftar Antrean</a></li>
            <li><a href="/riwayatpasien" class="active"><i class="fas fa-history"></i> Riwayat Pasien</a></li>
        </ul>

        <div class="logout">
            <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        
        <!-- HEADER & SEARCH -->
        <div class="header-container">
            <h1>Riwayat Pasien</h1>
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari pasien...">
            </div>
        </div>

        <!-- CONTENT WRAPPER -->
        <div class="content-wrapper">
            
            <!-- KOLOM KIRI: PROFIL PASIEN -->
            <div class="profile-card">
                <div class="profile-header">
                    <div class="avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="profile-name">Andi Saputra</div>
                </div>
                <div class="profile-details">
                    <div class="detail-row">
                        <span class="detail-label">No. RM</span>
                        <span class="detail-value">0001</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Tanggal Lahir</span>
                        <span class="detail-value">12-05-1995</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Jenis Kelamin</span>
                        <span class="detail-value">Laki-laki</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">No. HP</span>
                        <span class="detail-value">081234567890</span>
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: RIWAYAT MEDIS -->
            <div class="history-table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Berobat</th>
                            <th>Dokter</th>
                            <th>Keluhan</th>
                            <th>Diagnosa</th>
                            <th>Tindakan</th>
                            <th>Resep</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Baris 1 -->
                        <tr>
                            <td>1</td>
                            <td>27 Mei 2024</td>
                            <td>Dr. Budi Santoso</td>
                            <td>Demam, Pusing</td>
                            <td>Flu</td>
                            <td>Istirahat, Minum Obat</td>
                            <td>Paracetamol</td>
                        </tr>
                        <!-- Baris 2 -->
                        <tr>
                            <td>2</td>
                            <td>15 April 2024</td>
                            <td>Dr. Budi Santoso</td>
                            <td>Batuk, Pilek</td>
                            <td>ISPA</td>
                            <td>Minum Obat, Istirahat</td>
                            <td>CTM</td>
                        </tr>
                        <!-- Baris 3 -->
                        <tr>
                            <td>3</td>
                            <td>10 Maret 2024</td>
                            <td>Dr. Budi Santoso</td>
                            <td>Sakit Tenggorokan</td>
                            <td>Radang Tenggorokan</td>
                            <td>Kumur Air Garam</td>
                            <td>Samnol</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</body>
</html><?php /**PATH C:\poliklinik28\resources\views/riwayatpasien.blade.php ENDPATH**/ ?>