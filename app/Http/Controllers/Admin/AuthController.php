<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Login admin buat moderasi Chat Room. Gak ada link ke sini dari menu,
 * dan gak ada halaman daftar. Akun admin dibikin lewat:
 *   php artisan portfolio:make-admin
 */
class AuthController extends Controller
{
    public function create(): View
    {
        return view('admin.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);

        if (! Auth::attempt([...$credentials, 'is_admin' => true])) {
            throw ValidationException::withMessages([
                'email' => 'Email or password is incorrect.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('chat'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('chat');
    }
}
