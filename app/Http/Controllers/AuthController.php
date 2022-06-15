<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function changePassword(Request $request)
    {
        try {
            return view('auth.passwords.change');
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function storeChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'password' => 'required|min:8|same:password_confirmation',
                'password_confirmation' => 'required|min:8|same:password',
        ]);

        $validator->validate();
        try {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()->with('success', 'Berhasil merubah password'); 
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal merubah password');
        }
    }
}
