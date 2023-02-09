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
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
            'jk' => ['required'],
            'status' => ['required'],
            'telp' => ['required'],
            'pekerjaan' => ['required'],
        ];

        if ($data['role'] == 2) {
            $rules['ktp'] = ['required'];
            $rules['kk'] = ['required'];
        }

        return Validator::make($data, $rules);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function create(array $data)
    {
        $validator = validator($data);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $attributes = [
            'role_id' => $data['role'],
            'name' => $data['name'],
            'email' => $data['email'],
            'jk' => $data['jk'],
            'status' => $data['status'],
            'telp' => $data['telp'],
            'pekerjaan' => $data['pekerjaan'],
            'password' => Hash::make($data['password']),
        ];

        if ($data['role'] != 3) {
            $kk = $data['kk'];
            $new_kk = 'KK' . "-" . $data['name'] . "." . $kk->getClientOriginalExtension();
            $kkDest = 'images/kk';
            $kk->move($kkDest, $new_kk);

            $ktp = $data['ktp'];
            $new_ktp = 'KTP' . "-" . $data['name'] . "." . $ktp->getClientOriginalExtension();
            $ktpDest = 'images/ktp';
            $ktp->move($ktpDest, $new_ktp);

            $attributes['foto_ktp'] = $new_ktp;
            $attributes['foto_kk'] = $new_kk;
            $attributes['aktif'] = 0;
        } else {
            $attributes['aktif'] = 1;
        }
        $user = User::create($attributes);
        $user->assignRole($data['role']);
        return $user;
    }
}
