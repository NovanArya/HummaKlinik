<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Dokter - Poliklinik Sehat</title>
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
        .action-bar { display:flex; align-items:center; gap:15px; }
        .btn-tambah { background-color:#1a73e8; color:white; border:none; padding:10px 20px; border-radius:5px; cursor:pointer; font-weight:600; display:flex; align-items:center; gap:8px; }
        .btn-tambah:hover { background-color:#1557b0; }
        .table-card { background:white; border-radius:10px; padding:20px; box-shadow:0 2px 10px rgba(0,0,0,0.05); }
        table { width:100%; border-collapse:collapse; }
        th { text-align:left; padding:12px 15px; background-color:#f9fafb; color:#555; font-weight:600; border-bottom:1px solid #eee; }
        td { padding:12px 15px; border-bottom:1px solid #f5f5f5; color:#333; font-size:14px; }
        tr:last-child td { border-bottom:none; }
        .action-buttons { display:flex; gap:5px; }
        .btn-action { border:none; padding:5px 10px; border-radius:4px; cursor:pointer; color:white; font-size:12px; }
        .btn-edit { background-color:#2196f3; }
        .btn-edit:hover { background-color:#1976d2; }
        .btn-delete { background-color:#f44336; }
        .btn-delete:hover { background-color:#d32f2f; }
        /* Modal */
        .modal-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); z-index:999; align-items:center; justify-content:center; }
        .modal-overlay.show { display:flex; animation:fadeIn 0.2s ease; }
        @keyframes fadeIn { from{opacity:0;transform:scale(0.95)} to{opacity:1;transform:scale(1)} }
        .modal { background:white; border-radius:10px; padding:30px; width:100%; max-width:480px; box-shadow:0 8px 30px rgba(0,0,0,0.15); }
        .modal h3 { font-size:18px; margin-bottom:20px; color:#333; }
        .form-group { margin-bottom:15px; }
        .form-group label { display:block; font-size:13px; color:#555; margin-bottom:5px; font-weight:600; }
        .form-group input, .form-group select { width:100%; padding:9px 12px; border:1px solid #ddd; border-radius:6px; font-size:14px; outline:none; transition:border 0.2s; }
        .form-group input:focus, .form-group select:focus { border-color:#1a73e8; }
        .form-row { display:grid; grid-template-columns:1fr 1fr; gap:15px; }
        .modal-footer { display:flex; justify-content:flex-end; gap:10px; margin-top:20px; }
        .btn-batal { background:#6c757d; color:white; border:none; padding:9px 20px; border-radius:5px; cursor:pointer; font-weight:600; }
        .btn-simpan { background:#1a73e8; color:white; border:none; padding:9px 20px; border-radius:5px; cursor:pointer; font-weight:600; }
        @media(max-width:768px){ .sidebar{display:none;} .main-content{margin-left:0;width:100%;padding:15px;} }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo-area"><i class="fas fa-hospital-user"></i><span>Poliklinik Sehat</span></div>
        <ul class="nav-menu">
            <li><a href="/"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="/user"><i class="fas fa-user"></i> User</a></li>
            <li><a href="/jadwaldokter" class="active"><i class="fas fa-calendar-check"></i> Jadwal Dokter</a></li>
            <li><a href="/jadwalpasien"><i class="fas fa-calendar-alt"></i> Jadwal Pasien</a></li>
            <li><a href="/antrean"><i class="fas fa-clipboard-list"></i> Daftar Antrean</a></li>
            <li><a href="/riwayatpasien"><i class="fas fa-history"></i> Riwayat Pasien</a></li>
        </ul>
        @auth
            <div class="logout"><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></div>
        @else
            <div class="logout"><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a></div>
        @endauth
    </div>

    <div class="main-content">
        <div class="header-container">
            <h1>Jadwal Dokter</h1>
            <div class="action-bar">
                <button class="btn-tambah" onclick="bukaModalTambah()"><i class="fas fa-plus"></i> Tambah Jadwal</button>
            </div>
        </div>

        @if(session('success'))
        <div style="background:#d4edda;color:#155724;padding:12px 15px;border-radius:5px;margin-bottom:20px;display:flex;justify-content:space-between;align-items:center;">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.style.display='none'" style="background:none;border:none;cursor:pointer;font-size:18px;">&times;</button>
        </div>
        @endif

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>No</th><th>Nama Dokter</th><th>Spesialis</th><th>Hari</th><th>Jam Mulai</th><th>Jam Selesai</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwals as $i => $jadwal)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $jadwal->nama_dokter }}</td>
                        <td>{{ $jadwal->spesialis }}</td>
                        <td>{{ $jadwal->hari }}</td>
                        <td>{{ $jadwal->jam_mulai }}</td>
                        <td>{{ $jadwal->jam_selesai }}</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-edit"
                                    onclick="bukaModalEdit({{ $jadwal->id }},'{{ addslashes($jadwal->nama_dokter) }}','{{ addslashes($jadwal->spesialis) }}','{{ $jadwal->hari }}','{{ $jadwal->jam_mulai }}','{{ $jadwal->jam_selesai }}')">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <form method="POST" action="/jadwaldokter/{{ $jadwal->id }}" style="display:inline;" onsubmit="return confirm('Yakin hapus jadwal ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" style="text-align:center;padding:20px;color:#999;">Belum ada jadwal dokter</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah / Edit Jadwal Dokter -->
    <div class="modal-overlay" id="modalJadwal">
        <div class="modal">
            <h3 id="modalTitle">Tambah Jadwal Dokter</h3>
            <form id="formJadwal" method="POST" action="/jadwaldokter">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <div class="form-group">
                    <label>Nama Dokter <span style="color:red">*</span></label>
                    <input type="text" name="nama_dokter" id="inputNamaDokter" required>
                </div>
                <div class="form-group">
                    <label>Spesialis <span style="color:red">*</span></label>
                    <input type="text" name="spesialis" id="inputSpesialis" placeholder="Umum, Gigi, Mata, dll" required>
                </div>
                <div class="form-group">
                    <label>Hari <span style="color:red">*</span></label>
                    <select name="hari" id="inputHari" required>
                        <option value="">-- Pilih Hari --</option>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $hari)
                        <option value="{{ $hari }}">{{ $hari }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Jam Mulai <span style="color:red">*</span></label>
                        <input type="time" name="jam_mulai" id="inputJamMulai" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Selesai <span style="color:red">*</span></label>
                        <input type="time" name="jam_selesai" id="inputJamSelesai" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-batal" onclick="tutupModal()">Batal</button>
                    <button type="submit" class="btn-simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function bukaModalTambah() {
            document.getElementById('modalTitle').textContent = 'Tambah Jadwal Dokter';
            document.getElementById('formJadwal').action = '/jadwaldokter';
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('formJadwal').reset();
            document.getElementById('modalJadwal').classList.add('show');
        }
        function bukaModalEdit(id, nama, spesialis, hari, mulai, selesai) {
            document.getElementById('modalTitle').textContent = 'Edit Jadwal Dokter';
            document.getElementById('formJadwal').action = '/jadwaldokter/' + id;
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('inputNamaDokter').value = nama;
            document.getElementById('inputSpesialis').value = spesialis;
            document.getElementById('inputHari').value = hari;
            document.getElementById('inputJamMulai').value = mulai;
            document.getElementById('inputJamSelesai').value = selesai;
            document.getElementById('modalJadwal').classList.add('show');
        }
        function tutupModal() {
            document.getElementById('modalJadwal').classList.remove('show');
        }
        document.getElementById('modalJadwal').addEventListener('click', function(e) {
            if (e.target === this) tutupModal();
        });
    </script>
</body>
</html>
