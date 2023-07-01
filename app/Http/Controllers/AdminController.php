<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
  public function AdminLogout(Request $request)
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');
  }

  public function Profile()
  {
    $id = Auth::user()->id;
    $adminData = User::find($id);

    return view(
      'admin.admin_profile_view',
      compact('adminData')
    );
  } // End Method 
}
