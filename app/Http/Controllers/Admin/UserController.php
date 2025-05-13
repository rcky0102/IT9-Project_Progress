<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['patient', 'doctor', 'patient.user', 'doctor.user'])->get();

        return view('admin.users.index', compact('users'));
    }

}
