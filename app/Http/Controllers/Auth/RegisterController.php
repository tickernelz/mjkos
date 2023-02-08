<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function registered(Request $request, $user)
    {
        if (!Auth::user()->aktif == 1) {
            Auth::logout();
            return redirect()->route('login')->with('error', "Registrasi berhasil, tunggu konfirmasi dari admin!");
        }
        Auth::logout();
        return redirect()->route('login')->with('info', "Registrasi berhasil");
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
            'jk' => ['required'],
            'status' => ['required'],
            'telp' => ['required'],
            'pekerjaan' => ['required'],
            'ktp' => ['required'],
            'kk' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function create(array $data)
    {
        $kk = $data['kk'];
        $name = $data['name'];
        $role = $data['role'];
        $new_kk = 'KK' . "-" . $name . "." . $kk->getClientOriginalExtension();
        $destination = 'images/kk';
        $kk->move($destination, $new_kk);

        $ktp = $data['ktp'];
        $new_ktp = 'KTP' . "-" . $name . "." . $ktp->getClientOriginalExtension();
        $destination = 'images/ktp';
        $ktp->move($destination, $new_ktp);

        if ($role == 3) {
            $aktif = 1;
        } else {
            $aktif = 0;
        }

        $user = User::create([
            'role_id' => $role,
            'name' => $data['name'],
            'email' => $data['email'],
            'jk' => $data['jk'],
            'status' => $data['status'],
            'telp' => $data['telp'],
            'pekerjaan' => $data['pekerjaan'],
            'foto_ktp' => $new_ktp,
            'foto_kk' => $new_kk,
            'aktif' => $aktif,
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole($role);
        return $user;
    }
}
