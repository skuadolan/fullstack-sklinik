<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Response;

class ConfirmablePasswordController extends Controller
{
    private const ROOT_VIEW_PATH = 'Auth';

    private static function pageView($component, $props = []): Response
    {
        $component = self::ROOT_VIEW_PATH."/{$component}";

        return self::inertiaView($component, $props);
    }

    /**
     * Show the confirm password view.
     */
    public function show(): Response
    {
        return self::pageView('ConfirmPassword');
    }

    /**
     * Confirm the user's password.
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
