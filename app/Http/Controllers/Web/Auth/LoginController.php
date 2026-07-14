<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    private const ALLOWED_TYPES = ['admin', 'registrar', 'accounting', 'admission'];

    public function create(string $type)
    {
        abort_unless(in_array($type, self::ALLOWED_TYPES), 404);

        return view("auth.login-{$type}");
    }

    public function store(Request $request, string $type): RedirectResponse
    {
        abort_unless(in_array($type, self::ALLOWED_TYPES), 404);

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'type' => $type,
        ], $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }
}
