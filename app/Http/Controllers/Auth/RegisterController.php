<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserCategory;
use App\Models\UserMeta;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
    protected $redirectTo = RouteServiceProvider::ACCOUNT;

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
            'phone' => ['required', 'string', 'min:14', 'max:14', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            //'start_of_work_year' => ['required', 'integer'],
            //'start_of_work_month' => ['required', 'integer'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'unique_id' => Str::random(11),
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => str_replace(["(", ")", "-", " "], "", $data['phone']),
            'date_of_birth' => null,
            'gender' => 1,
            'photo' => null,
            'balance' => 0,
            'price' => $data['price'] ?? 0,
            'role' => $data['role'],
            'status' => 0,
            'password' => Hash::make($data['password']),
        ]);

        //$user->assignRole($data['role']);

        $metas = [
            'start_of_work_year',
            'start_of_work_month',
            'qualification',
            'education',
            'training',
            'place_of_work', //clinic
            'address'
        ];
        //dd($data['category_id']);

        if(isset($data['category_id'])) {
            foreach($data['category_id'] as $category_id) {
                UserCategory::create([
                   'category_id' => $category_id,
                   'user_id' => $user->id,
                ]);
            }
        }

        foreach ($metas as $meta) {
            UserMeta::create([
                'user_id' => $user->id,
                'key' => $meta,
                'value' => $data[$meta]
            ]);
        }

        return $user;

    }
}
