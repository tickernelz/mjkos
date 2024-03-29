<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Kos;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexAdmin()
    {
        return view('backend.dashboard');
    }

    public function profile()
    {
        return view('frontend.profile');
    }

    public function updateProfile(Request $request, User $user)
    {
        $user_id = auth()->user()->id;
        #Validations
        $request->validate([
            'name' => 'required',
            'jk' => 'required',
            'pekerjaan' => 'required',
            'status' => 'required',
            'email' => 'required|unique:users,email,' . $user_id . ',id',
        ]);

        #Update Profile Data
        $user = User::whereId($user_id)->update([
            'name' => $request->name,
            'jk' => $request->jk,
            'pekerjaan' => $request->pekerjaan,
            'status' => $request->status,
            'email' => $request->email
        ]);

        if ($user) {
            return back()->with('success', 'Profile Berhasil diubah.');
        } else {
            return redirect()->back()->with('error', 'User Gagal ditambah!.');
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        #Update Password
        $user = User::find(auth()->user()->id)->update(['password' => bcrypt($request->new_password)]);
        if ($user) {
            return back()->with('success', 'Profile Berhasil diubah.');
        } else {
            return redirect()->back()->with('error', 'User Gagal ditambah!.');
        }
    }

    public function updateFoto(Request $request, User $user)
    {
        $user_id = Auth::user()->id;
        if ($request->foto) {
            $usercek = User::whereid($user_id)->first();
            if ($usercek->foto && file_exists(public_path() . '/images/profil/' . $usercek->foto)) {
                unlink(public_path() . '/images/profil/' . $usercek->foto);
            }
            $foto = $request->foto;
            $new_foto = Auth::user()->name . "-" . time() . "." . $foto->getClientOriginalExtension();
            $destination = 'images/profil/';
            $foto->move($destination, $new_foto);
            // Store Data
            $user_updated = User::whereId($user_id)->update([
                'foto' => $new_foto,
            ]);
        }
        if ($user_updated) {
            return redirect()->back()->with('success', 'Foto Berhasil diperbarui!.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Foto Gagal diperbarui!.');
        }
    }

    public function updateDokumen(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $user_name = $user->name;

        $ktp = $request->ktp;
        $kk = $request->kk;

        if ($ktp) {
            $new_ktp = 'KTP' . "-" . $user_name . "." . $ktp->getClientOriginalExtension();
            $ktpDest = 'images/ktp/';
            $ktp->move($ktpDest, $new_ktp);
        }

        if ($kk) {
            $new_kk = 'KK' . "-" . $user_name . "." . $kk->getClientOriginalExtension();
            $kkDest = 'images/kk/';
            $kk->move($kkDest, $new_kk);
        }

        $user_updated = User::whereId($user_id)->update([
            'foto_ktp' => $ktp ? $new_ktp : $user->foto_ktp,
            'foto_kk' => $kk ? $new_kk : $user->foto_kk,
        ]);

        if ($user_updated) {
            return redirect()->back()->with('success', 'Dokuemn Berhasil diperbarui!.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Dokumen Gagal diperbarui!.');
        }
    }
}
