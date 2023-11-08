<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\User;



class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'password' => ['required', 'confirmed', 'min:8'],
            ],
            [
                'password.min' => 'Mật khẩu không đủ 8 ký tự',
                'password.confirmed' => 'Xác nhận mật khẩu không đúng',
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Login after registration successfully
        Auth::login($user);

        $notification = array(
            'message' => "Đăng ký thành công",
            "alert-type" => "success"
        );


        return redirect(RouteServiceProvider::HOME)->with($notification);
    }
}
