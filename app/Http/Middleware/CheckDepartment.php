<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckDepartment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  mixed ...$departments
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$departments)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $userDepartment = $user->department->nama_departemen ?? null;

        foreach ($departments as $department) {
            if ($department === 'PEGAWAI') {
                // Jika user bukan HR atau FINANCE, izinkan akses
                if ($userDepartment !== "HR" && $userDepartment !== "FINANCE") {
                    return $next($request);
                }
            } else {
                // Jika user sesuai dengan department yang diminta, izinkan akses
                if ($userDepartment === $department) {
                    return $next($request);
                }
            }
        }

        // Jika tidak memenuhi syarat, redirect ke home (menggunakan route)
        return redirect()->route('home');
    }
}
