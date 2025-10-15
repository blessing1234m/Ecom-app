<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        $admin = $request->user('admin');

        if (! $admin) {
            return redirect()->route('admin.login');
        }

        if ($admin->hasVerifiedEmail()) {
            return redirect()->route('admin.dashboard');
        }

        $admin->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
