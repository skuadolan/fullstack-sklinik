<?php

namespace App\Http\Controllers\Auth;

use Inertia\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class EmailVerificationPromptController extends Controller
{
    public function __construct() {
        parent::__construct("Pages/Auth");
    }

    public function __invoke(Request $request): RedirectResponse|Response
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('dashboard', absolute: false))
                    : $this->view("VerifyEmail", ['status' => session('status')]);
    }
}
