<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Antrean - Poliklinik Sehat</title>
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
        .btn-tambah { background-color:#28a745; color:white; border:none; padding:10px 20px; border-radius:5px; cursor:pointer; font-weight:600; display:flex; align-items:center; gap:8px; }
        .btn-tambah:hover { background-color:#218838; }
        .content-wrapper { display:flex; gap:20px; flex-wrap:wrap; }
        .queue-info { flex:1; min-width:250px; background:white; border-radius:10px; padding:30px; box-shadow:0 2px 10px rgba(0,0,0,0.05); text-align:center; display:flex; flex-direction:column; justify-content:center; }
        .queue-label { font-size:14px; color:#666; font-weight:500; margin-bottom:10px; }
        .queue-number { font-size:64px; font-weight:bold; color:#333; margin-bottom:15px; }
        .patient-name { font-size:18px; font-weight:600; color:#333; }
        .patient-detail { font-size:14px; color:#666; margin-bottom:20px; }
        .btn-panggil { background-color:#28a745; color:white; border:none; padding:10px; border-radius:5px; cursor:pointer; font-weight:600; margin-top:10px; width:100%; }
        .btn-panggil:hover { background-color:#218838; }
        .queue-table-container { flex:2; min-width:400px; background:white; border-radius:10px; padding:20px; box-shadow:0 2px 10px rgba(0,0,0,0.05); }
        table { width:100%; border-collapse:collapse; }
        th { text-align:left; padding:12px 15px; background-color:#f9fafb; color:#555; font-weight:600; border-bottom:1px solid #eee; }
        td { padding:12px 15px; border-bottom:1px solid #f5f5f5; color:#333; font-size:14px; }
        tr:last-child td { border-bottom:none; }
        .status-badge { padding:4px 12px; border-radius:20px; font-size:12px; font-weight:500; display:inline-block; }
        .status-diperiksa { background-color:#d4edda; color:#155724; }
        .status-menunggu { background-color:#fff3cd; color:#856404; }
        .status-selesai { background-color:#d1ecf1; color:#0c5460; }
        .btn-play { background-color:#1a73e8; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer; }
        .btn-play:hover { background-color:#1557b0; }
        .btn-delete { background-color:#f44336; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer; }
        .btn-delete:hover { background-color:#d32f2f; }
        .btn-selesai { background-color:#6c757d; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer; }
        .btn-selesai:hover { background-color:#545b62; }
        /* Modal */
        .modal-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); z-index:999; align-items:center; justify-content:center; }
        .modal-overlay.show { display:flex; animation:fadeIn 0.2s ease; }
        @keyframes fadeIn { from{opacity:0;transform:scale(0.95)} to{opacity:1;transform:scale(1)} }
        .modal { background:white; border-radius:10px; padding:30px; width:100%; max-width:500px; box-shadow:0 8px 30px rgba(0,0,0,0.15); }
        .modal h3 { font-size:18px; margin-bottom:20px; color:#333; }
        .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:15px; margin-bottom:15px; }
        .form-group { margin-bottom:0; }
        .form-group label { display:block; font-size:13px; color:#555; margin-bottom:5px; font-weight:600; }
        .form-group input, .form-group select { width:100%; padding:9px 12px; border:1px solid #ddd; border-radius:6px; font-size:14px; outline:none; }
        .form-group input:focus, .form-group select:focus { border-color:#28a745; }
        .modal-footer { display:flex; justify-content:flex-end; gap:10px; margin-top:20px; }
        .btn-batal-modal { background:#6c757d; color:white; border:none; padding:9px 20px; border-radius:5px; cursor:pointer; font-weight:600; }
        .btn-simpan-modal { background:#28a745; color:white; border:none; padding:9px 20px; border-radius:5px; cursor:pointer; font-weight:600; }
        @media(max-width:768px){ .sidebar{display:none;} .main-content{margin-left:0;width:100%;padding:15px;} .content-wrapper{flex-direction:column;} }
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
            <li><a href="/antrean" class="active"><i class="fas fa-clipboard-list"></i> Daftar Antrean</a></li>
            <li><a href="/riwayatpasien"><i class="fas fa-history"></i> Riwayat Pasien</a></li>
        </ul>
        <?php if(auth()->guard()->check()): ?>
            <div class="logout"><a href="<?php echo e(route('logout')); ?>"><i class="fas fa-sign-out-alt"></i> Logout</a></div>
        <?php else: ?>
            <div class="logout"><a href="<?php echo e(route('login')); ?>"><i class="fas fa-sign-in-alt"></i> Login</a></div>
        <?php endif; ?>
    </div>

    <div class="main-content">
        <div class="header-container">
            <h1>Daftar Antrean</h1>
            <div class="action-bar">
                <button class="btn-tambah" onclick="bukaModalTambah()"><i class="fas fa-plus"></i> Tambah Antrean</button>
            </div>
        </div>

        <?php if(session('success')): ?>
        <div style="background:#d4edda;color:#155724;padding:12px 15px;border-radius:5px;margin-bottom:20px;display:flex;justify-content:space-between;align-items:center;">
            <span><?php echo e(session('success')); ?></span>
            <button onclick="this.parentElement.style.display='none'" style="background:none;border:none;cursor:pointer;font-size:18px;">&times;</button>
        </div>
        <?php endif; ?>
        <?php if(session('info')): ?>
        <div style="background:#d1ecf1;color:#0c5460;padding:12px 15px;border-radius:5px;margin-bottom:20px;display:flex;justify-content:space-between;align-items:center;">
            <span><?php echo e(session('info')); ?></span>
            <button onclick="this.parentElement.style.display='none'" style="background:none;border:none;cursor:pointer;font-size:18px;">&times;</button>
        </div>
        <?php endif; ?>

        <div class="content-wrapper">
            <!-- Kolom kiri: Antrean sekarang -->
            <div class="queue-info">
                <div class="queue-label">Nomor Antrean Sekarang</div>
                <?php if($currentQueue): ?>
                    <div class="queue-number"><?php echo e(str_pad($currentQueue->no_antrean, 3, '0', STR_PAD_LEFT)); ?></div>
                    <div class="patient-name"><?php echo e($currentQueue->nama_pasien); ?></div>
                    <div class="patient-detail"><?php echo e($currentQueue->poli); ?> — <?php echo e($currentQueue->dokter ?? '-'); ?></div>
                    <!-- Tombol Selesai (hanya untuk yang sedang diperiksa) -->
                    <form method="POST" action="<?php echo e(route('antrean.selesai', $currentQueue)); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-selesai" style="width:100%;margin-top:8px;">
                            <i class="fas fa-check"></i> Selesai
                        </button>
                    </form>
                <?php else: ?>
                    <div class="queue-number">-</div>
                    <div class="patient-name">Tidak ada pasien</div>
                    <div class="patient-detail">-</div>
                <?php endif; ?>
                <!-- Tombol Panggil Berikutnya -->
                <form method="POST" action="<?php echo e(route('antrean.panggil')); ?>" style="margin-top:10px;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-panggil">
                        <i class="fas fa-bullhorn"></i>
                        <?php echo e($currentQueue ? 'Panggil Berikutnya' : 'Panggil Pertama'); ?>

                    </button>
                </form>
                <?php if($nextQueue): ?>
                <div style="margin-top:12px;font-size:13px;color:#666;">
                    Berikutnya: <strong><?php echo e($nextQueue->nama_pasien); ?></strong> (#<?php echo e(str_pad($nextQueue->no_antrean,3,'0',STR_PAD_LEFT)); ?>)
                </div>
                <?php endif; ?>
            </div>

            <!-- Kolom kanan: Daftar antrean -->
            <div class="queue-table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No. Antrean</th><th>Nama Pasien</th><th>Poli</th><th>Dokter</th><th>Status</th><th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $antreens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $antrean): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e(str_pad($antrean->no_antrean, 3, '0', STR_PAD_LEFT)); ?></td>
                            <td><?php echo e($antrean->nama_pasien); ?></td>
                            <td><?php echo e($antrean->poli); ?></td>
                            <td><?php echo e($antrean->dokter ?? '-'); ?></td>
                            <td>
                                <span class="status-badge status-<?php echo e($antrean->status); ?>">
                                    <?php echo e(ucfirst($antrean->status)); ?>

                                </span>
                            </td>
                            <td>
                                <div style="display:flex;gap:5px;">
                                    <button class="btn-play"
                                        onclick="bukaModalEdit(<?php echo e($antrean->id); ?>,'<?php echo e(addslashes($antrean->nama_pasien)); ?>','<?php echo e(addslashes($antrean->poli)); ?>','<?php echo e(addslashes($antrean->dokter ?? '')); ?>','<?php echo e($antrean->status); ?>')">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <?php if($antrean->status === 'diperiksa'): ?>
                                    <form method="POST" action="<?php echo e(route('antrean.selesai', $antrean)); ?>" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn-selesai" title="Selesai & masuk riwayat">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <?php endif; ?>
                                    <form method="POST" action="<?php echo e(route('antrean.destroy', $antrean)); ?>" style="display:inline;" onsubmit="return confirm('Yakin hapus?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn-delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="6" style="text-align:center;padding:20px;color:#999;">Tidak ada data antrean</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah / Edit Antrean -->
    <div class="modal-overlay" id="modalAntrean">
        <div class="modal">
            <h3 id="modalTitle">Tambah Antrean Baru</h3>
            <form id="formAntrean" method="POST" action="<?php echo e(route('antrean.store')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <div class="form-grid">
                    <div class="form-group" style="grid-column:1/-1;">
                        <label>Nama Pasien <span style="color:red">*</span></label>
                        <input type="text" name="nama_pasien" id="inputNamaPasien" required>
                    </div>
                    <div class="form-group">
                        <label>Poli <span style="color:red">*</span></label>
                        <select name="poli" id="inputPoli" required>
                            <option value="">-- Pilih Poli --</option>
                            <option value="Poli Umum">Poli Umum</option>
                            <option value="Poli Gigi">Poli Gigi</option>
                            <option value="Poli Mata">Poli Mata</option>
                            <option value="Poli Anak">Poli Anak</option>
                            <option value="Poli Kandungan">Poli Kandungan</option>
                            <option value="Poli THT">Poli THT</option>
                            <option value="Poli Kulit">Poli Kulit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Dokter</label>
                        <select name="dokter" id="inputDokter">
                            <option value="">-- Pilih Dokter --</option>
                            <?php $__currentLoopData = $jadwals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($j->nama_dokter); ?>"><?php echo e($j->nama_dokter); ?> (<?php echo e($j->spesialis); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <!-- Kolom status hanya muncul saat edit -->
                    <div class="form-group" id="statusGroup" style="display:none;grid-column:1/-1;">
                        <label>Status</label>
                        <select name="status" id="inputStatus">
                            <option value="menunggu">Menunggu</option>
                            <option value="diperiksa">Diperiksa</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                </div>
                <div id="noAntreanInfo" style="font-size:13px;color:#666;margin-top:5px;">
                    Nomor antrean akan ditetapkan otomatis: <strong>#<?php echo e(str_pad($nextNo, 3, '0', STR_PAD_LEFT)); ?></strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-batal-modal" onclick="tutupModal()">Batal</button>
                    <button type="submit" class="btn-simpan-modal">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function bukaModalTambah() {
            document.getElementById('modalTitle').textContent = 'Tambah Antrean Baru';
            document.getElementById('formAntrean').action = '<?php echo e(route("antrean.store")); ?>';
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('formAntrean').reset();
            document.getElementById('statusGroup').style.display = 'none';
            document.getElementById('noAntreanInfo').style.display = 'block';
            document.getElementById('modalAntrean').classList.add('show');
        }
        function bukaModalEdit(id, nama, poli, dokter, status) {
            document.getElementById('modalTitle').textContent = 'Edit Antrean';
            document.getElementById('formAntrean').action = '/antrean/' + id;
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('inputNamaPasien').value = nama;
            document.getElementById('inputPoli').value = poli;
            document.getElementById('inputDokter').value = dokter;
            document.getElementById('inputStatus').value = status;
            document.getElementById('statusGroup').style.display = 'block';
            document.getElementById('noAntreanInfo').style.display = 'none';
            document.getElementById('modalAntrean').classList.add('show');
        }
        function tutupModal() {
            document.getElementById('modalAntrean').classList.remove('show');
        }
        document.getElementById('modalAntrean').addEventListener('click', function(e) {
            if (e.target === this) tutupModal();
        });
    </script>
</body>
</html>
<?php /**PATH C:\poliklinik_v2\resources\views/antrean.blade.php ENDPATH**/ ?>