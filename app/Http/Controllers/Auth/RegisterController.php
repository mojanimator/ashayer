<?php

namespace App\Http\Controllers\Auth;

use App\Mail\RegisterUserMail;
use App\Role;
use App\Rules\Recaptcha;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Morilog\Jalali\CalendarUtils;

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
    protected $redirectTo = '/login';

    protected function redirectTo()
    {
        return '/login';
//        if (auth()->user()->role_id == 1) {
//            return '/admin';
//        }
//        return '/panel/' . auth()->user()->username;
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
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'recaptcha' => ['required', new  Recaptcha()],
            'username' => 'required|string|min:6|max:20|unique:users',
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'family' => 'required|string|min:3|max:50',
            'phone_number' => 'required|numeric|max:99999999999999999999',
            'email' => ['required', 'string', 'email', 'min:6', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'max:50', 'confirmed'],
            'access_all' => 'required|boolean',
            'access_view_schools' => 'required|boolean',
            'access_create_schools' => 'required|boolean',
            'access_edit_schools' => 'required|boolean',
            'access_remove_schools' => 'required|boolean',
            'access_view_users' => 'required|boolean',
            'access_create_users' => 'required|boolean',
            'access_edit_users' => 'required|boolean',
            'access_remove_users' => 'required|boolean',
            'hoozes_all' => 'required|boolean',
            'deactivate_user' => 'required|boolean',
            "hoozes" => "nullable|array",
            "hoozes.*" => "numeric|exists:hoozes,id",
        ], [
            'recaptcha.required' => 'لطفا گزینه من ربات نیستم را تایید نمایید',
            'username.required' => 'نام کاربری ضروری است',
            'username.string' => 'نام کاربری نمی تواند عدد باشد',
            'username.min' => 'نام کاربری حداقل 6 حرف باشد',
            'username.max' => 'نام کاربری حداکثر 20 حرف باشد',
            'username.unique' => 'نام کاربری تکراری است',
            'name.required' => 'نام  ضروری است',
            'name.string' => 'نام  نمی تواند عدد باشد',
            'name.min' => 'نام  حداقل 3 حرف باشد',
            'name.max' => 'نام  حداکثر 50 حرف باشد',
            'family.required' => 'نام خانوادگی ضروری است',
            'family.string' => 'نام خانوادگی نمی تواند عدد باشد',
            'family.min' => 'نام خانوادگی حداقل 3 حرف باشد',
            'family.max' => 'نام خانوادگی  حداکثر 50 حرف باشد',
            'phone_number.required' => 'شماره تماس ضروری است',
            'phone_number.numeric' => 'شماره تماس باید عدد باشد',
            'phone_number.max' => 'شماره تماس حداکثر 20 عدد باشد',
            'email.required' => 'ایمیل ضروری است',
            'email.string' => 'ایمیل نامعتبر است',
            'email.email' => 'ایمیل نامعتبر است',
            'email.min' => 'ایمیل حداقل 6 حرف باشد',
            'email.max' => 'ایمیل حداکثر 50 حرف باشد',
            'email.unique' => 'ایمیل تکراری است',
            'password.required' => 'گذرواژه  ضروری است',
            'password.string' => 'گذرواژه  نمی تواند فقط عدد باشد',
            'password.min' => 'گذرواژه  حداقل 6 حرف باشد',
            'password.max' => 'گذرواژه  حداکثر 50 حرف باشد',
            'password.confirmed' => 'گذرواژه با تکرار آن مطابقت ندارد',
            'access_all.required' => 'پارامتر دسترسی نامعتبر است',
            'access_all.boolean' => 'پارامتر دسترسی نامعتبر است',
            'access_view_schools.required' => 'پارامتر دسترسی نامعتبر است',
            'access_view_schools.boolean' => 'پارامتر دسترسی نامعتبر است',
            'access_create_schools.required' => 'پارامتر دسترسی نامعتبر است',
            'access_create_schools.boolean' => 'پارامتر دسترسی نامعتبر است',
            'access_edit_schools.required' => 'پارامتر دسترسی نامعتبر است',
            'access_edit_schools.boolean' => 'پارامتر دسترسی نامعتبر است',
            'access_remove_schools.required' => 'پارامتر دسترسی نامعتبر است',
            'access_remove_schools.boolean' => 'پارامتر دسترسی نامعتبر است',
            'access_view_users.required' => 'پارامتر دسترسی نامعتبر است',
            'access_view_users.boolean' => 'پارامتر دسترسی نامعتبر است',
            'access_create_users.required' => 'پارامتر دسترسی نامعتبر است',
            'access_create_users.boolean' => 'پارامتر دسترسی نامعتبر است',
            'access_edit_users.required' => 'پارامتر دسترسی نامعتبر است',
            'access_edit_users.boolean' => 'پارامتر دسترسی نامعتبر است',
            'access_remove_users.required' => 'پارامتر دسترسی نامعتبر است',
            'access_remove_users.boolean' => 'پارامتر دسترسی نامعتبر است',
            'hoozes_all.required' => 'پارامتر دسترسی نامعتبر است',
            'hoozes_all.boolean' => 'پارامتر دسترسی نامعتبر است',
            'deactivate_user.required' => 'پارامتر دسترسی نامعتبر است',
            'deactivate_user.boolean' => 'پارامتر دسترسی نامعتبر است',
            'hoozes.array' => 'نوع حوزه ها نامعتبر است',
            "hoozes.*.numeric" => "نوع حوزه ها نامعتبر است",
            "hoozes.*.exists" => "حوزه ها موجود نیستند!",
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $date = Carbon::now();
        $user = null;
        DB::transaction(function () use ($data, & $user) {
            $user = User::create([
                'username' => $data['username'],
                'name' => $data['name'],
                'family' => $data['family'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'role' => $data['access_all'] == true && $data['hoozes_all'] == true ? 0 : null, //superuser
                'password' => Hash::make($data['password']),
                'token' => bin2hex(openssl_random_pseudo_bytes(30)),
                'expires_at' => $data['ex_date'] ? CalendarUtils::createCarbonFromFormat('Y/m/d', $data['ex_date'])->addDays(1)->timezone('Asia/Tehran') : null,
            ]);

            $hooze_ids = array();


            if ($data['hoozes_all'] == true)
                array_push($hooze_ids, 'all');


            Role::create([
                'user_id' => $user->id,
                'permissions' => json_encode($this->create_access($data)),
                'hooze_ids' => $data['hoozes_all'] == true ? json_encode(['all']) : json_encode($data['hoozes']),
            ]);

            Mail::to($user->email)->send(new RegisterUserMail($user->token));
//            Mail::to($user->email)->queue(new OrderShipped($order));
        });
        return $user;
    }

    public function verify($token)
    {
        if (!$token) {
            return redirect('login')->with('flash-error', 'لینک نامعتبر است!');
        }


        $user = User::where('token', $token)->first();


        if (!$user) {
            return redirect('login')->with('flash-error', 'لینک منقضی شده است!');
        }

        $user->verified = 1;

        if ($user->save()) {

            return redirect('login')->with('flash-success', 'ثبت نام شما با موفقیت کامل شد!');

        }

    }

    public function create_access(array $data)
    {
        $roles = array();
        if ($data['access_all'] == true)
            array_push($roles, 'all');
        else {
            if ($data['access_view_schools'] == true)
                array_push($roles, 'vs');
            if ($data['access_create_schools'] == true)
                array_push($roles, 'cs');
            if ($data['access_edit_schools'] == true)
                array_push($roles, 'es');
            if ($data['access_remove_schools'] == true)
                array_push($roles, 'rs');
            if ($data['access_view_users'] == true)
                array_push($roles, 'vu');
            if ($data['access_create_users'] == true)
                array_push($roles, 'cu');
            if ($data['access_edit_users'] == true)
                array_push($roles, 'eu');
            if ($data['access_remove_users'] == true)
                array_push($roles, 'ru');
        }
        return $roles;
    }

    public function showRegistrationForm()
    {
//        if (Gate::denies('isSuperuser')) {
//            abort(404, ' مجوز دسترسی ندارید!');
//        }
        return view('auth.register');
    }

    protected function registered(Request $request, $user)
    {
//        $this->guard()->logout();
        return redirect('login')->with('flash-success', 'برای تکمیل ثبت نام لطفا ایمیل خود را تایید کنید پیام تایید ایمیل  برای شما ارسال شده است');
    }

    public function resend(Request $request)
    {
//        $this->guard()->logout();
        $user = User::where('token', $request->token)->first();
//        return redirect('login')->with('flash-success', $user->token);
        if ($user) {
            Mail::to($user->email)->send(new RegisterUserMail($user->token));
            return redirect('login')->with('flash-success', 'برای تکمیل ثبت نام لطفا ایمیل خود را تایید کنید پیام تایید ایمیل  برای شما ارسال شد');
        } else {
            return redirect('login')->with('flash-error', 'کاربر وجود ندارد!');

        }
    }
}
