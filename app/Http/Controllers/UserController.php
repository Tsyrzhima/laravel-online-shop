<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrateRequest;
use App\Models\User;
use App\Services\RabbitmqService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController
{
    private RabbitmqService $rabbitmqService;
    public function __construct(RabbitmqService $rabbitmqService)
    {
        $this->rabbitmqService = $rabbitmqService;
    }
    public function getRegistrationForm()
    {
        return view('registrationForm');
    }
    public function getLogin()
    {
        return view('loginForm');
    }
    public function getProfile()
    {
        $user = Auth::user();
        return view('profile', ['user' => $user]);
    }
    public function getEditProfile()
    {
        $user = Auth::user();
        return view('editProfileForm', ['user' => $user]);
    }

    public function editProfile(EditProfileRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();
        if(!empty($request['name']) && ($user->name !== $data['name'])){
            $user->name = $data['name'];
        };
        if(!empty($request['email']) && ($user->email !== $data['email'])){
            $user->email = $data['email'];
        };
        if(!empty($request['password']) && ($user->password !== Hash::make($data['password']))){
            $user->password = Hash::make($data['password']);
        };

        $user->save();

        return response()->redirectTo('/profile');
    }

    public function registrate(RegistrateRequest $request)
    {
        $data = $request->validated();

        $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $this->rabbitmqService->produce(['user_id' => $user->id], 'sign-up-email');

        return response()->redirectTo('/login');
    }
    public function login(LoginRequest $request)
    {
        if(Auth::attempt($request->only('email', 'password')))
        {
            return response()->redirectTo('/catalog');
        };

        return back()->withErrors([
            'Auth' => 'Неверные учетные данные',
        ]);

    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
