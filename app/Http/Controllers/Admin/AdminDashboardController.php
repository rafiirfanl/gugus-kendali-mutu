<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view:dashboard')->only(['index']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboard');
    }

}
