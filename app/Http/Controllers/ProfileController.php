<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User; // Asegúrate de importar el modelo User

class ProfileController extends Controller
{
    /**
     * Muestra el formulario de edición de perfil
     */
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Actualiza el perfil del usuario
     */
    public function update(Request $request)
    {
        // Obtiene el modelo User del usuario autenticado
        $user = User::find(Auth::id());

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Actualizar datos básicos
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Manejar cambio de contraseña
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'La contraseña actual no es correcta'
                ]);
            }
            $user->password = Hash::make($validatedData['new_password']);
        }

        // Guarda los cambios en la base de datos
        $user->save();

        return redirect()->route('profile.edit')
            ->with('success', 'Perfil actualizado correctamente');
    }
}