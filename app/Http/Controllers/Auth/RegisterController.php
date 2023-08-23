<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Campus;
use App\Models\Faculty;
use App\Models\Major;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
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
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create($data)
    {
        $topics = null;
        if(array_key_exists('topics', $data)) {
            $topics = $data['topics'];
        }
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'nim' => $data['nim'],
            'campus_id' => $data['campus_id'],
            'faculty_id' => $data['faculty_id'],
            'major_id' => $data['major_id'],
            'topics' => $topics,
        ]);

        $user->communities()->sync($data['communities'] ?? []);
        $user->categories()->sync($data['categories'] ?? []);

        return $user;
    }

    public function register(UserRequest $request)
    {
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    public function showRegistrationForm()
    {
        $campus=Campus::all();
        $faculty=Faculty::all();
        $major=Major::all();
        return view('auth.register')->with('campus', $campus)->with('faculty', $faculty)->with('major', $major);

    }
}
