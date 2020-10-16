<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Event;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Laravolt\Indonesia\Models\Province;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'              => $data['name'],
            'email'             => $data['email'],
            'password'          => Hash::make($data['password']),
            'jenis_kelamin'     => $data['jenis_kelamin'],
            'event_id'          => $data['event_id'],
            'asal_sekolah'      => $data['asal_sekolah'],
            'kelas'             => $data['kelas'],
            'provinsi_id'       => $data['provinsi_id'],
            'kabupaten_kota_id' => $data['kabupaten_kota_id'],
            'alamat_tinggal'    => $data['alamat_tinggal'],
            'no_telepon'        => $data['no_telepon'],
            'status'            => 0,
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register', [
            'events'    => Event::latest()->get(),
            'provinces' => Province::pluck('name', 'id'),
        ]);
    }

    // public function getProvince() {
    //     return view('auth.register', [
    //     ]);
    // }

    public function getKabupatenKota(Request $request) {
        $cities = City::where('province_id', $request->get('id'))
            ->pluck('name', 'id');

        return response()->json($cities);
    }
}
