<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    public function index(Request $request) {
        $search = $request->get('search');
        $users  = User::when($search, fn($q) => $q->where('name','like',"%$search%")
                                                   ->orWhere('username','like',"%$search%")
                                                   ->orWhere('role','like',"%$search%"))
                       ->paginate(10)->withQueryString();
        return view('user', compact('users','search'));
    }

    public function store(Request $request) {
        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|unique:users|max:50',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:Admin,Petugas,Dokter,Pasien',
        ]);
        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);
        return back()->with('success','User berhasil ditambahkan.');
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|unique:users,username,'.$user->id,
            'email'    => 'required|email|unique:users,email,'.$user->id,
            'role'     => 'required|in:Admin,Petugas,Dokter,Pasien',
        ]);
        $data = $request->only(['name','username','email','role']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return back()->with('success','User berhasil diperbarui.');
    }

    public function destroy(User $user) {
        $user->delete();
        return back()->with('success','User berhasil dihapus.');
    }
}
