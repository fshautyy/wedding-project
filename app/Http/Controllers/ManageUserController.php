<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\App;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'superuser') {

            $users = User::where('role', 'user')
                ->select('id', 'name', 'email', 'email_verified_at')
                ->orderBy('name', 'asc')
                ->get();

            $apps = App::with('user')->select('user_id', 'app_name', 'app_slug', 'settings')
                ->orderBy('app_name', 'asc')
                ->get();


            return view('dashboard', compact(['users','apps']));
        }

        return view('dashboard');
    }

    public function show($id)
    {
        $user = User::where('role', 'user')
            ->select('id', 'name', 'email', 'email_verified_at')
            ->findOrFail($id);

        return  redirect()->intended(route('dashboard', absolute: false));
    }
    public function verify($id)
    {
        $user = User::where('role', 'user')->findOrFail($id);

        $user->email_verified_at = now();
        $user->save();

        return back()->with('success', 'User berhasil diverifikasi.');
    }
}
