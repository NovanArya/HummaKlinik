<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pasien - Poliklinik Sehat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif; }
        body { background-color:#f3f6fd; display:flex; height:100vh; }
        .sidebar { width:250px; background-color:#1a2332; color:#b0b8c6; display:flex; flex-direction:column; padding:20px; height:100vh; position:fixed; left:0; top:0; z-index:100; }
        .logo-area { display:flex; align-items:center; color:white; font-weight:bold; font-size:18px; margin-bottom:40px; }
        .logo-area i { font-size:24px; margin-right:10px; color:#4a90e2; }
        .nav-menu { list-style:none; flex-grow:1; }
        .nav-menu li { margin-bottom:5px; }
        .nav-menu a { display:flex; align-items:center; padding:12px 15px; color:#b0b8c6; text-decoration:none; border-radius:8px; transition:all 0.3s; font-size:14px; }
        .nav-menu a i { width:25px; margin-right:10px; }
        .nav-menu a:hover { background-color:#263446; color:white; }
        .nav-menu a.active { background-color:#2d68c4; color:white; }
        .logout { margin-top:auto; padding-top:20px; border-top:1px solid #2c3e50; }
        .logout a { color:#b0b8c6; text-decoration:none; display:flex; align-items:center; padding:10px; }
        .logout a:hover { color:white; }
        .main-content { margin-left:250px; width:calc(100% - 250px); padding:30px; overflow-y:auto; height:100vh; }
        .header-container { display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; flex-wrap:wrap; gap:15px; }
        .header-container h1 { font-size:24px; color:#333; }
        .search-box { position:relative; }
        .search-box input { padding:8px 15px 8px 35px; border:1px solid #ddd; border-radius:20px; width:250px; font-size:14px; outline:none; transition:border 0.3s; }
        .search-box input:focus { border-color:#1a73e8; }
        .search-box i { position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#999; }
        .content-wrapper { display:flex; gap:20px; flex-wrap:wrap; }
        /* Kolom kiri: profile */
        .profile-card { flex:1; min-width:250px; max-width:350px; background:white; border-radius:10px; padding:25px; box-shadow:0 2px 10px rgba(0,0,0,0.05); }
        .profile-header { display:flex; align-items:center; gap:15px; margin-bottom:20px; }
        .avatar { width:60px; height:60px; background-color:#e3f2fd; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#1a73e8; font-size:30px; }
        .profile-name { font-size:18px; font-weight:600; color:#333; }
        .profile-details { display:flex; flex-direction:column; gap:10px; }
        .detail-row { display:flex; justify-content:space-between; font-size:14px; border-bottom:1px solid #f5f5f5; padding-bottom:8px; }
        .detail-row:last-child { border-bottom:none; }
        .detail-label { color:#666; }
        .detail-value { color:#333; font-weight:500; }
        /* Daftar pasien -->di bawah profil */
        .pasien-list { margin-top:15px; }
        .pasien-list-title { font-size:13px; font-weight:600; color:#555; margin-bottom:8px; }
        .pasien-item { display:block; padding:8px 12px; border-radius:6px; color:#333; text-decoration:none; font-size:13px; border:1px solid #eee; margin-bottom:5px; transition:background 0.2s; }
        .pasien-item:hover { background:#f0f4ff; }
        .pasien-item.selected { background:#e3f2fd; border-color:#1a73e8; color:#1a73e8; font-weight:600; }
        /* Kolom kanan: riwayat medis */
        .history-table-container { flex:3; min-width:400px; background:white; border-radius:10px; padding:20px; box-shadow:0 2px 10px rgba(0,0,0,0.05); overflow-x:auto; }
        table { width:100%; border-collapse:collapse; min-width:600px; }
        th { text-align:left; padding:12px 15px; background-color:#f9fafb; color:#555; font-weight:600; border-bottom:1px solid #eee; font-size:13px; }
        td { padding:12px 15px; border-bottom:1px solid #f5f5f5; color:#333; font-size:14px; }
        tr:last-child td { border-bottom:none; }
        @media(max-width:768px){ .sidebar{display:none;} .main-content{margin-left:0;width:100%;padding:15px;} .content-wrapper{flex-direction:column;} .profile-card{max-width:100%;} }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo-area"><i class="fas fa-hospital-user"></i><span>Poliklinik Sehat</span></div>
        <ul class="nav-menu">
            <li><a href="/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="/user"><i class="fas fa-user"></i> User</a></li>
            <li><a href="/jadwaldokter"><i class="fas fa-calendar-check"></i> Jadwal Dokter</a></li>
            <li><a href="/jadwalpasien"><i class="fas fa-calendar-alt"></i> Jadwal Pasien</a></li>
            <li><a href="/antrean"><i class="fas fa-clipboard-list"></i> Daftar Antrean</a></li>
            <li><a href="/riwayatpasien" class="active"><i class="fas fa-history"></i> Riwayat Pasien</a></li>
        </ul>
        <?php if(auth()->guard()->check()): ?>
            <div class="logout"><a href="<?php echo e(route('logout')); ?>"><i class="fas fa-sign-out-alt"></i> Logout</a></div>
        <?php else: ?>
            <div class="logout"><a href="<?php echo e(route('login')); ?>"><i class="fas fa-sign-in-alt"></i> Login</a></div>
        <?php endif; ?>
    </div>

    <div class="main-content">
        <div class="header-container">
            <h1>Riwayat Pasien</h1>
            <form method="GET" action="/riwayatpasien" style="display:contents;">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" placeholder="Cari pasien..." value="<?php echo e($search ?? ''); ?>"
                           onchange="this.form.submit()">
                </div>
            </form>
        </div>

        <div class="content-wrapper">
            <!-- Kolom kiri -->
            <div class="profile-card">
                <?php if($selectedNama): ?>
                <div class="profile-header">
                    <div class="avatar"><i class="fas fa-user"></i></div>
                    <div class="profile-name"><?php echo e($selectedNama); ?></div>
                </div>
                <div class="profile-details">
                    <div class="detail-row">
                        <span class="detail-label">Total Kunjungan</span>
                        <span class="detail-value"><?php echo e($detailRiwayat->count()); ?>x</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Kunjungan Terakhir</span>
                        <span class="detail-value">
                            <?php echo e($detailRiwayat->first() ? \Carbon\Carbon::parse($detailRiwayat->first()->tanggal_kunjungan)->format('d M Y') : '-'); ?>

                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Poli Terakhir</span>
                        <span class="detail-value"><?php echo e(optional($detailRiwayat->first())->poli ?? '-'); ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Dokter Terakhir</span>
                        <span class="detail-value"><?php echo e(optional($detailRiwayat->first())->dokter ?? '-'); ?></span>
                    </div>
                </div>
                <?php else: ?>
                <div style="text-align:center;color:#999;padding:20px;">Pilih pasien</div>
                <?php endif; ?>

                <!-- Daftar semua pasien -->
                <?php if($pasienList->count() > 0): ?>
                <div class="pasien-list">
                    <div class="pasien-list-title">Daftar Pasien</div>
                    <?php $__currentLoopData = $pasienList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="/riwayatpasien?pasien=<?php echo e(urlencode($p->nama_pasien)); ?><?php echo e($search ? '&search='.urlencode($search) : ''); ?>"
                       class="pasien-item <?php echo e($selectedNama === $p->nama_pasien ? 'selected' : ''); ?>">
                        <i class="fas fa-user-circle" style="margin-right:6px;"></i><?php echo e($p->nama_pasien); ?>

                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Kolom kanan -->
            <div class="history-table-container">
                <?php if($selectedNama): ?>
                <div style="font-size:16px;font-weight:600;color:#333;margin-bottom:15px;">
                    Riwayat Medis — <?php echo e($selectedNama); ?>

                </div>
                <?php endif; ?>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Poli</th>
                            <th>Dokter</th>
                            <th>Keluhan</th>
                            <th>Diagnosa</th>
                            <th>Tindakan</th>
                            <th>Resep</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $detailRiwayat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($i + 1); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($r->tanggal_kunjungan)->format('d M Y')); ?></td>
                            <td><?php echo e($r->poli); ?></td>
                            <td><?php echo e($r->dokter ?? '-'); ?></td>
                            <td><?php echo e($r->keluhan ?? '-'); ?></td>
                            <td><?php echo e($r->diagnosa ?? '-'); ?></td>
                            <td><?php echo e($r->tindakan ?? '-'); ?></td>
                            <td><?php echo e($r->resep ?? '-'); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="8" style="text-align:center;padding:20px;color:#999;">
                            <?php echo e($selectedNama ? 'Belum ada riwayat untuk pasien ini' : 'Pilih pasien dari daftar kiri'); ?>

                        </td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\poliklinik28\resources\views/riwayatpasien.blade.php ENDPATH**/ ?>