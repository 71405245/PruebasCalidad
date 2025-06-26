<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        $clientId = env('GOOGLE_CLIENT_ID');
        $redirectUri = urlencode(env('GOOGLE_REDIRECT'));

        $authUrl = "https://accounts.google.com/o/oauth2/v2/auth?" .
            "client_id={$clientId}&" .
            "redirect_uri={$redirectUri}&" .
            "response_type=code&" .
            "scope=openid%20email%20profile&" .
            "access_type=offline&" .
            "prompt=consent%20select_account";

        return redirect()->away($authUrl);
    }
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Debug: Verifica los datos recibidos de Google
            Log::info('Datos de Google:', (array)$googleUser);

            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => bcrypt(Str::random(16)),
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar ?? null,
                    'email_verified_at' => now(),
                ]);

                // Debug: Verifica el usuario creado
                Log::info('Usuario creado:', $user->toArray());
            } else {
                // Actualiza los datos de Google si el usuario ya existe
                $user->update([
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar ?? $user->avatar,
                ]);
            }

            Auth::login($user, true);

            // Debug: Verifica el login
            Log::info('Usuario autenticado:', [Auth::user()]);

            return redirect()->intended('/dashboard')
                ->with('success', '¡Bienvenido!');
        } catch (\Exception $e) {
            Log::error('Error en Google callback:', ['error' => $e->getMessage()]);
            return redirect()->route('login')
                ->with('error', 'Error al autenticar: ' . $e->getMessage());
        }
        dd([
            'googleUser' => $googleUser,
            'localUser' => $user,
            'authCheck' => Auth::check(),
            'authUser' => Auth::user()
        ]);
    }
}
