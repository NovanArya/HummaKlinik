<?php
use App\Http\Controllers\AntreanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JadwalDokterController;
use App\Http\Controllers\RiwayatPasienController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// User CRUD
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

// Jadwal Dokter CRUD
Route::get('/jadwaldokter', [JadwalDokterController::class, 'index'])->name('jadwaldokter');
Route::post('/jadwaldokter', [JadwalDokterController::class, 'store'])->name('jadwaldokter.store');
Route::put('/jadwaldokter/{jadwaldokter}', [JadwalDokterController::class, 'update'])->name('jadwaldokter.update');
Route::delete('/jadwaldokter/{jadwaldokter}', [JadwalDokterController::class, 'destroy'])->name('jadwaldokter.destroy');

// Jadwal Pasien (tampilan dari antrean)
Route::get('/jadwalpasien', function () {
    $antreens = \App\Models\Antrean::orderBy('no_antrean')->get();
    return view('jadwalpasien', ['antreens' => $antreens]);
})->name('jadwalpasien');

// Antrean CRUD + aksi
Route::get('/antrean', [AntreanController::class, 'index'])->name('antrean');
Route::post('/antrean', [AntreanController::class, 'store'])->name('antrean.store');
Route::put('/antrean/{antrean}', [AntreanController::class, 'update'])->name('antrean.update');
Route::delete('/antrean/{antrean}', [AntreanController::class, 'destroy'])->name('antrean.destroy');
Route::post('/antrean/panggil-berikutnya', [AntreanController::class, 'panggilBerikutnya'])->name('antrean.panggil');
Route::post('/antrean/{antrean}/selesai', [AntreanController::class, 'selesai'])->name('antrean.selesai');

// Riwayat Pasien
Route::get('/riwayatpasien', [RiwayatPasienController::class, 'index'])->name('riwayatpasien');

// Auth
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
})->name('login.submit');

Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name'                  => 'required|string|max:100',
        'email'                 => 'required|email|unique:users',
        'username'              => 'required|string|unique:users|max:50',
        'password'              => 'required|string|min:6|confirmed',
    ], [
        'name.required'              => 'Nama lengkap wajib diisi.',
        'email.required'             => 'Email wajib diisi.',
        'email.email'                => 'Format email tidak valid.',
        'email.unique'               => 'Email sudah digunakan.',
        'username.required'          => 'Username wajib diisi.',
        'username.unique'            => 'Username sudah digunakan.',
        'password.required'          => 'Password wajib diisi.',
        'password.min'               => 'Password minimal 6 karakter.',
        'password.confirmed'         => 'Konfirmasi password tidak cocok.',
    ]);

    \App\Models\User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'username' => $request->username,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        'role'     => 'Pasien',
    ]);

    return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login dengan akun Anda.');
})->name('register.submit');
