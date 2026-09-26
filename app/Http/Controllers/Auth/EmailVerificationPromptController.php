<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class EmailVerificationPromptController extends Controller
{
    private const ROOT_VIEW_PATH = 'Auth';

    private static function pageView($component, $props = []): Response
    {
        $component = self::ROOT_VIEW_PATH."/{$component}";

        return self::inertiaView($component, $props);
    }

    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|Response
    {
        return $request->user()->hasVerifiedEmail()
                ? redirect()->intended(route('dashboard', absolute: false))
                : self::pageView('VerifyEmail', ['status' => session('status')]);
    }
}
