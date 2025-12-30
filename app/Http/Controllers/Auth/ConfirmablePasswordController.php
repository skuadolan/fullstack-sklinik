<?php

namespace App\Http\Controllers\Auth;

use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class ConfirmablePasswordController extends Controller
{
    public function __construct() {
        parent::__construct("Pages/Auth");
    }
    
    public function show(): Response
    {
        return $this->view("ConfirmPassword");
    }

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
