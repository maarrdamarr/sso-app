<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles', 'department')->get();
        $roles = Role::all();

        return view('users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $this->authorizeCreate();

        $roles = Role::all();
        $departments = Department::all();

        return view('users.create', compact('roles', 'departments'));
    }

    public function store(Request $request)
    {
        $this->authorizeCreate();

        $data = $request->validate([
            'name' => 'required|string|max:150',
            'username' => 'required|string|max:100|unique:users,username',
            'email' => 'required|email|max:150|unique:users,email',
            'password' => 'required|string|min:6',
            'department_id' => 'nullable|exists:departments,id',
            'roles' => 'array',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'department_id' => $data['department_id'] ?? null,
        ]);

        /** @var \App\Models\User $current */
        $current = Auth::user();

        // HR hanya boleh buat karyawan
        if ($current->hasRole('hr')) {
            $karyawanRole = Role::where('name', 'karyawan')->first();
            if ($karyawanRole) {
                $user->roles()->sync([$karyawanRole->id]);
            }
        } else {
            // superadmin & it-admin boleh pilih
            $user->roles()->sync($data['roles'] ?? []);
        }

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dibuat.');
    }

    public function edit(User $user)
    {
        $this->authorizeEdit($user);

        $roles = Role::all();
        $departments = Department::all();

        return view('users.edit', compact('user', 'roles', 'departments'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorizeEdit($user);

        $data = $request->validate([
            'name' => 'required|string|max:150',
            'username' => 'required|string|max:100|unique:users,username,' . $user->id,
            'email' => 'required|email|max:150|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'department_id' => 'nullable|exists:departments,id',
            'roles' => 'array',
        ]);

        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->department_id = $data['department_id'] ?? null;

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        /** @var \App\Models\User $current */
        $current = Auth::user();

        // HR tidak boleh ganti role tinggi
        if ($current->hasRole('hr')) {
            // biarkan role existing saja
        } else {
            $user->roles()->sync($data['roles'] ?? []);
        }

        return redirect()->route('users.index')->with('success', 'Pengguna diperbarui.');
    }

    public function destroy(User $user)
    {
        $this->authorizeDelete($user);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna dihapus.');
    }

    public function updateRoles(Request $request, User $user)
    {
        /** @var \App\Models\User $current */
        $current = Auth::user();

        // hanya superadmin & it-admin
        if (!$current->hasRole(['superadmin', 'it-admin'])) {
            abort(403, 'Anda tidak boleh mengubah role.');
        }

        // tidak boleh ubah superadmin kalau bukan superadmin
        if ($user->hasRole('superadmin') && !$current->hasRole('superadmin')) {
            abort(403, 'Anda tidak boleh mengubah role superadmin.');
        }

        $roleIds = $request->input('roles', []);
        $user->roles()->sync($roleIds);

        return back()->with('success', 'Role pengguna diperbarui.');
    }

    // ================== helper otorisasi ==================

    protected function authorizeCreate(): void
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->hasRole(['superadmin', 'it-admin'])) {
            return;
        }

        // HR boleh create (nanti diset otomatis karyawan)
        if ($user->hasRole('hr')) {
            return;
        }

        abort(403, 'Anda tidak boleh menambah pengguna.');
    }

    protected function authorizeEdit(User $target): void
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // superadmin bebas
        if ($user->hasRole('superadmin')) {
            return;
        }

        // it-admin boleh edit siapa saja kecuali superadmin
        if ($user->hasRole('it-admin')) {
            if ($target->hasRole('superadmin')) {
                abort(403, 'Tidak boleh mengedit superadmin.');
            }
            return;
        }

        // HR hanya boleh edit user biasa
        if ($user->hasRole('hr')) {
            if ($target->hasRole(['superadmin', 'it-admin', 'hr'])) {
                abort(403, 'HR tidak boleh mengedit admin.');
            }
            return;
        }

        abort(403, 'Anda tidak boleh mengedit pengguna.');
    }

    protected function authorizeDelete(User $target): void
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // superadmin boleh hapus siapa saja kecuali dirinya sendiri
        if ($user->hasRole('superadmin')) {
            if ($user->id === $target->id) {
                abort(403, 'Tidak boleh menghapus akun sendiri.');
            }
            return;
        }

        // it-admin boleh hapus user biasa
        if ($user->hasRole('it-admin')) {
            if ($target->hasRole(['superadmin', 'it-admin', 'hr'])) {
                abort(403, 'Tidak boleh menghapus akun admin/HR.');
            }
            if ($user->id === $target->id) {
                abort(403, 'Tidak boleh menghapus akun sendiri.');
            }
            return;
        }

        // HR dan yang lain tidak boleh hapus
        abort(403, 'Anda tidak boleh menghapus pengguna.');
    }
}
