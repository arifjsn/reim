<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $department = Auth::user()->department->nama_departemen ?? null;

        if ($department === "HR") {
            return view('hr-home');
        } elseif ($department === "FINANCE") {
            return view('fin-home');
        } else {
            return view('home');
        }
    }
}
