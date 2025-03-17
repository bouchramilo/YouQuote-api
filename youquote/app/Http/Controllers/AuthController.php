<?php
namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $fields = $request->validate([
            'name'     => 'required|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed',

        ]);

        $user = User::create($fields);

        $token = $user->createToken('auth_token');
        return [
            'user'  => $user,
            'token' => $token->plainTextToken,
        ];
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|exists:users',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return [
                'message' => 'Email ou password est incorrect !!',
            ];
        }

        $token = $user->createToken('auth_token');
        return [
            'user'  => $user,
            'token' => $token->plainTextToken,
        ];
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();

        return ['message'=> 'Vous étes déconnecter avec succes'];
    }

}
