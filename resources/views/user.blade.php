<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User - Poliklinik Sehat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif; }
        body { background-color:#f3f6fd; display:flex; height:100vh; }
        .sidebar { width:250px; background-color:#1a2332; color:#b0b8c6; display:flex; flex-direction:column; padding:20px; height:100vh; position:fixed; left:0; top:0; }
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
        .search-box { position:relative; }
        .search-box input { padding:8px 15px 8px 35px; border:1px solid #ddd; border-radius:20px; width:250px; font-size:14px; outline:none; transition:border 0.3s; }
        .search-box input:focus { border-color:#1a73e8; }
        .search-box i { position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#999; }
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
        .pagination-container { display:flex; justify-content:center; margin-top:20px; gap:5px; }
        .page-item { padding:6px 12px; border:1px solid #ddd; border-radius:5px; color:#555; text-decoration:none; font-size:14px; background:white; }
        .page-item.active { background-color:#1a73e8; color:white; border-color:#1a73e8; }
        .page-item:hover:not(.active) { background-color:#f1f1f1; }
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
            <li><a href="/user" class="active"><i class="fas fa-user"></i> User</a></li>
            <li><a href="/jadwaldokter"><i class="fas fa-calendar-check"></i> Jadwal Dokter</a></li>
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
            <h1>Data User</h1>
            <div class="action-bar">
                <button class="btn-tambah" onclick="bukaModalTambah()"><i class="fas fa-plus"></i> Tambah User+</button>
                <form method="GET" action="/user" style="display:contents;">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" name="search" placeholder="Cari user..." value="{{ $search ?? '' }}"
                               onchange="this.form.submit()">
                    </div>
                </form>
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
                        <th>No</th><th>Nama</th><th>Username</th><th>Role</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $i => $user)
                    <tr>
                        <td>{{ $users->firstItem() + $i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-edit"
                                    onclick="bukaModalEdit({{ $user->id }},'{{ addslashes($user->name) }}','{{ addslashes($user->username) }}','{{ addslashes($user->email) }}','{{ $user->role }}')">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <form method="POST" action="/user/{{ $user->id }}" style="display:inline;" onsubmit="return confirm('Yakin hapus user ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align:center;padding:20px;color:#999;">Tidak ada data user</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pagination-container">{{ $users->links('pagination::simple-tailwind') }}</div>
        </div>
    </div>

    <!-- Modal Tambah / Edit User -->
    <div class="modal-overlay" id="modalUser">
        <div class="modal">
            <h3 id="modalTitle">Tambah User</h3>
            <form id="formUser" method="POST" action="/user">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <div class="form-group">
                    <label>Nama Lengkap <span style="color:red">*</span></label>
                    <input type="text" name="name" id="inputName" required>
                </div>
                <div class="form-group">
                    <label>Username <span style="color:red">*</span></label>
                    <input type="text" name="username" id="inputUsername" required>
                </div>
                <div class="form-group">
                    <label>Email <span style="color:red">*</span></label>
                    <input type="email" name="email" id="inputEmail" required>
                </div>
                <div class="form-group">
                    <label>Password <span id="passNote" style="color:red">*</span></label>
                    <input type="password" name="password" id="inputPassword">
                </div>
                <div class="form-group">
                    <label>Role <span style="color:red">*</span></label>
                    <select name="role" id="inputRole" required>
                        <option value="Admin">Admin</option>
                        <option value="Petugas">Petugas</option>
                        <option value="Dokter">Dokter</option>
                        <option value="Pasien">Pasien</option>
                    </select>
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
            document.getElementById('modalTitle').textContent = 'Tambah User';
            document.getElementById('formUser').action = '/user';
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('inputName').value = '';
            document.getElementById('inputUsername').value = '';
            document.getElementById('inputEmail').value = '';
            document.getElementById('inputPassword').value = '';
            document.getElementById('inputPassword').required = true;
            document.getElementById('passNote').textContent = '*';
            document.getElementById('inputRole').value = 'Petugas';
            document.getElementById('modalUser').classList.add('show');
        }
        function bukaModalEdit(id, name, username, email, role) {
            document.getElementById('modalTitle').textContent = 'Edit User';
            document.getElementById('formUser').action = '/user/' + id;
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('inputName').value = name;
            document.getElementById('inputUsername').value = username;
            document.getElementById('inputEmail').value = email;
            document.getElementById('inputPassword').value = '';
            document.getElementById('inputPassword').required = false;
            document.getElementById('passNote').textContent = '(kosongkan jika tidak diubah)';
            document.getElementById('inputRole').value = role;
            document.getElementById('modalUser').classList.add('show');
        }
        function tutupModal() {
            document.getElementById('modalUser').classList.remove('show');
        }
        document.getElementById('modalUser').addEventListener('click', function(e) {
            if (e.target === this) tutupModal();
        });
    </script>
</body>
</html>
