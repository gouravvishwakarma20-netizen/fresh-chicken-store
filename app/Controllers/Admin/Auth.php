<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    private const MAX_LOGIN_ATTEMPTS = 5;
    private const LOCKOUT_SECONDS = 900; // 15 minutes

    public function login()
    {
        if (session()->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/dashboard'));
        }

        return view('admin/auth/login');
    }

    public function attemptLogin()
    {
        // Rate limiting check
        $attempts = session()->get('login_attempts') ?? 0;
        $lastAttempt = session()->get('login_last_attempt') ?? 0;

        if ($attempts >= self::MAX_LOGIN_ATTEMPTS) {
            $elapsed = time() - $lastAttempt;
            if ($elapsed < self::LOCKOUT_SECONDS) {
                $remaining = ceil((self::LOCKOUT_SECONDS - $elapsed) / 60);
                return redirect()->back()
                    ->with('error', "Too many failed attempts. Please try again in {$remaining} minutes.")
                    ->withInput();
            }
            // Lockout expired, reset
            session()->set('login_attempts', 0);
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->authenticate($username, $password);

        if ($user) {
            // Reset login attempts on success
            session()->remove(['login_attempts', 'login_last_attempt']);

            session()->set([
                'admin_logged_in' => true,
                'admin_id'        => $user['id'],
                'admin_name'      => $user['name'],
                'admin_username'  => $user['username'],
            ]);

            // Regenerate session ID to prevent session fixation
            session()->regenerate(true);

            return redirect()->to(base_url('admin/dashboard'));
        }

        // Track failed attempt
        session()->set([
            'login_attempts'    => ($attempts + 1),
            'login_last_attempt' => time(),
        ]);

        return redirect()->back()->with('error', 'Invalid username or password')->withInput();
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('admin/login'));
    }
}
