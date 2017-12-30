<?php

namespace App\Http\Controllers\Auth;

use App\Customer;
use App\Http\Controllers\Controller;
use DebugBar\DebugBar;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Support\Facades\Schema;
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
    protected $redirectTo = '/';

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
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'    => 'required|string|max:255',
            'second_name'   => 'string|nullable|max:255',
            'surname'       => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:customers',
            'password'      => 'required|string|min:6|confirmed',
            'address'       => 'required|string|min:8',
            'city'          => 'required|string',
            'state'         => 'required|string',
            'country'       => 'required|string',
            'phone'         => 'required|digits_between:6,10|unique:customers',
            'zip-code'      => 'required|alpha_dash'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\Customer
     */
    protected function create(array $data)
    {
        app('debugbar')->warning($data);
            return Customer::create([
                'first_name'    => $data['first_name' ],
                'second_name'   => $data['second_name'],
                'surname'       => $data['surname'    ],
                'email'         => $data['email'      ],
                'password'      => bcrypt($data['password']),
                'address'       => $data['address'    ],
                'city'          => $data['city'       ],
                'state'         => $data['state'      ],
                'country'       => $data['country'    ],
                'phone'         => $data['phone'      ],
                'zip-code'      => $data['zip-code'   ]
            ]);
    }
}
