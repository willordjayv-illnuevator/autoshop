<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = $request->user();

        $role = $user->currentRole();

        if (!$role) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            // return redirect('/login')
            return redirect()->intended(route('shop.dashboard'))->withErrors([
                'email' => 'No role assigned to this user.'
            ]);;
        }

        /*
        |----------------------------------------
        | SHOP USER
        |----------------------------------------
        */
        if ($role->shop_id) {

            // optional: preload shop context
            $shop = $user->activeShop();

            // return redirect()->route('shop.dashboard');
            return redirect()->route('dashboard');
        }

        /*
        |----------------------------------------
        | CUSTOMER USER
        |----------------------------------------
        */
        if ($role->customer_id) {
            // return redirect()->route('customer.dashboard');
            return redirect()->route('dashboard');
        }

        return redirect()->route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
