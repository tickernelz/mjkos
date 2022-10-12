<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $id_user = Auth::user()->id;
        $user = User::where('id', '!=', $id_user)
            ->get();
        return view('backend.users.index', compact('user'));
    }

    public function create()
    {
        $roles = Role::where('id', '>', 1)->get();
        return view('backend.users.add', compact('roles'));
    }

    public function store(Request $request)
    {
        // Validations
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'status' => 'required|numeric|in:0,1',
            'aktif' => 'required',
            'pekerjaan' => 'required',
            'jk' => 'required',
            'telp' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role,
            'status' => $request->status,
            'aktif' => $request->aktif,
            'pekerjaan' => $request->pekerjaan,
            'jk' => $request->jk,
            'telp' => $request->telp,
            'password' => bcrypt('password')
        ]);

        // Assign Role To User
        $user->assignRole($request->role);
        if ($user) {
            return redirect()->route('pengguna.index')->with('success', 'Pengguna Berhasil ditambah!.');
        }
        return redirect()->route('pengguna.index')->with('error', 'Pengguna Gagal ditambah!.');
    }

    public function show($id)
    {
        $user = User::whereId($id)->first();
        return view('backend.users.detail', compact('user'));
    }

    public function edit($id)
    {
        $roles = Role::where('id', '>', 1)->get();
        $user = User::whereId($id)->first();
        return view('backend.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        // $foto = Transaksi::whereId($request->id)->first();
        // if (file_exists(public_path() . '/images/kk' . $foto->foto_kk)) {
        //     unlink(public_path() . '/images/kk' . $foto->foto_kk);
        // }
        // $kk = $request->kk;
        // $new_kk = 'KK' . "-" . Auth::user()->name . "." . $kk->getClientOriginalExtension();
        // $destination = 'images/kk';
        // $kk->move($destination, $new_kk);


        // if (file_exists(public_path() . '/images/ktp' . $foto->foto_ktp)) {
        //     unlink(public_path() . '/images/ktp' . $foto->foto_ktp);
        // }
        // $ktp = $request->ktp;
        // $new_ktp = 'KTP' . "-" . Auth::user()->name . "." . $ktp->getClientOriginalExtension();
        // $destination = 'images/ktp';
        // $ktp->move($destination, $new_ktp);
        // Validations
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'status' => 'required|numeric|in:0,1',
            'aktif' => 'required',
            'pekerjaan' => 'required',
            'jk' => 'required',
            'telp' => 'required',
        ]);

        $user = User::whereId($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'aktif' => $request->aktif,
            'pekerjaan' => $request->pekerjaan,
            'jk' => $request->jk,
            'telp' => $request->telp,
        ]);

        // Assign Role To User
        // $user->assignRole($user->role_id);
        if ($user) {
            return redirect()->route('pengguna.index')->with('success', 'Pengguna Berhasil diubah!.');
        }
        return redirect()->route('pengguna.index')->with('error', 'Pengguna Gagal diubah!.');
    }

    public function updateAktif($user_id, $aktif)
    {
        // Validation
        Validator::make([
            'user_id' => $user_id,
            'aktif' => $aktif
        ], [
            'user_id' => 'required|exists:users,id',
            'aktif' => 'required|in:0,1',
        ]);
        $user_id = decrypt($user_id);
        // Update aktif
        $user = User::whereId($user_id)->update(['aktif' => $aktif]);

        // Masssage
        if ($user) {
            if ($aktif == 0) {
                return redirect()->route('pengguna.index')->with('info', 'Status Akun Pengguna Inactive!.');
            }
            return redirect()->route('pengguna.index')->with('info', 'Status Akun Pengguna Active!.');
        } else {
            return redirect()->route('pengguna.index')->with('error', 'Gagal diperbarui');
        }
    }

    public function reset(Request $request)
    {
        $id = $request->reset_id;
        User::whereId($id)->update(['password' => bcrypt('password')]);
        return redirect()->back()->with('success', 'Password Berhasil direset!.');
    }

    public function destroy($id, Request $request)
    {
        $delete = User::whereId($request->delete_id)->delete();
        if ($delete) {
            return redirect()->route('pengguna.index')->with('success', 'Pengguna Berhasil dihapus!.');
        } else {
            return redirect()->back()->with('error', 'Pengguna Gagal dihapus!.');
        }
    }
}
