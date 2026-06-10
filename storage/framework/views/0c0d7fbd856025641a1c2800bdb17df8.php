<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Pasien - Poliklinik Sehat</title>
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

        .action-bar {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-tambah {
            background-color: #1a73e8;
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
            background-color: #1557b0;
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

        /* --- TABLE SECTION --- */
        .table-card {
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

        .status-badge {
            background-color: #e3f2fd;
            color: #1976d2;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .btn-action {
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            font-size: 12px;
        }

        .btn-edit {
            background-color: #2196f3;
        }
        
        .btn-edit:hover { background-color: #1976d2; }

        .btn-delete {
            background-color: #f44336;
        }

        .btn-delete:hover { background-color: #d32f2f; }

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
            .action-bar {
                width: 100%;
                flex-direction: column;
                align-items: flex-start;
            }
            .search-box {
                width: 100%;
            }
            .search-box input {
                width: 100%;
            }
            .btn-tambah {
                width: 100%;
                justify-content: center;
            }
            table {
                font-size: 12px;
            }
            th, td {
                padding: 8px 10px;
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
            <li><a href="/jadwalpasien" class="active"><i class="fas fa-calendar-alt"></i> Jadwal Pasien</a></li>
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
        
        <!-- HEADER & TOMBOL TAMBAH -->
        <div class="header-container">
            <h1>Jadwal Pasien</h1>
            <div class="action-bar">
                <button class="btn-tambah" onclick="bukaModalJanji()"><i class="fas fa-plus"></i> Tambah Janji</button>
                <form method="GET" action="/jadwalpasien" style="display:contents;">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" placeholder="Cari pasien..." value="<?php echo e(request('search')); ?>" onchange="this.form.submit()">
                </div>
                </form>
            </div>
        </div>

        <!-- TABLE JADWAL PASIEN -->
        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Antrean</th>
                        <th>Pasien</th>
                        <th>Poli</th>
                        <th>Dokter</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
    $search = request('search');
    $filteredAntreens = $search
        ? $antreens->filter(fn($a) => str_contains(strtolower($a->nama_pasien), strtolower($search)))
        : $antreens;
?>
<?php $__empty_1 = true; $__currentLoopData = $filteredAntreens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $antrean): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td><?php echo e(str_pad($antrean->no_antrean, 3, '0', STR_PAD_LEFT)); ?></td>
                            <td><?php echo e($antrean->nama_pasien); ?></td>
                            <td><?php echo e($antrean->poli); ?></td>
                            <td><?php echo e($antrean->dokter ?? '-'); ?></td>
                            <td><span class="status-badge" style="background-color: #e3f2fd; color: #1976d2;"><?php echo e(ucfirst($antrean->status)); ?></span></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 20px; color: #999;">
                                Tidak ada data jadwal pasien
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>


    <!-- Modal Tambah Janji -->
    <div id="modalJanji" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.45);z-index:999;align-items:center;justify-content:center;">
        <div style="background:white;border-radius:10px;padding:30px;width:100%;max-width:480px;box-shadow:0 8px 30px rgba(0,0,0,0.15);">
            <h3 style="font-size:18px;margin-bottom:20px;color:#333;">Tambah Janji Pasien</h3>
            <form method="POST" action="<?php echo e(route('antrean.store')); ?>">
                <?php echo csrf_field(); ?>
                <div style="margin-bottom:15px;">
                    <label style="display:block;font-size:13px;color:#555;margin-bottom:5px;font-weight:600;">Nama Pasien <span style="color:red">*</span></label>
                    <input type="text" name="nama_pasien" required style="width:100%;padding:9px 12px;border:1px solid #ddd;border-radius:6px;font-size:14px;outline:none;">
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:15px;margin-bottom:15px;">
                    <div>
                        <label style="display:block;font-size:13px;color:#555;margin-bottom:5px;font-weight:600;">Poli <span style="color:red">*</span></label>
                        <select name="poli" required style="width:100%;padding:9px 12px;border:1px solid #ddd;border-radius:6px;font-size:14px;">
                            <option value="">-- Pilih Poli --</option>
                            <option value="Poli Umum">Poli Umum</option>
                            <option value="Poli Gigi">Poli Gigi</option>
                            <option value="Poli Mata">Poli Mata</option>
                            <option value="Poli Anak">Poli Anak</option>
                            <option value="Poli Kandungan">Poli Kandungan</option>
                            <option value="Poli THT">Poli THT</option>
                        </select>
                    </div>
                    <div>
                        <label style="display:block;font-size:13px;color:#555;margin-bottom:5px;font-weight:600;">Dokter</label>
                        <select name="dokter" style="width:100%;padding:9px 12px;border:1px solid #ddd;border-radius:6px;font-size:14px;">
                            <option value="">-- Pilih Dokter --</option>
                            <?php $__currentLoopData = \App\Models\JadwalDokter::orderBy('nama_dokter')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($jd->nama_dokter); ?>"><?php echo e($jd->nama_dokter); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:20px;">
                    <button type="button" onclick="tutupModalJanji()" style="background:#6c757d;color:white;border:none;padding:9px 20px;border-radius:5px;cursor:pointer;font-weight:600;">Batal</button>
                    <button type="submit" style="background:#1a73e8;color:white;border:none;padding:9px 20px;border-radius:5px;cursor:pointer;font-weight:600;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <style>@keyframes fadeIn{from{opacity:0;transform:scale(0.95)}to{opacity:1;transform:scale(1)}}</style>
    <script>
        function bukaModalJanji(){var m=document.getElementById('modalJanji');m.style.display='flex';}
        function tutupModalJanji(){document.getElementById('modalJanji').style.display='none';}
        document.getElementById('modalJanji').addEventListener('click',function(e){if(e.target===this)tutupModalJanji();});
    </script>

</body>
</html><?php /**PATH C:\poliklinik_v2\resources\views/jadwalpasien.blade.php ENDPATH**/ ?>