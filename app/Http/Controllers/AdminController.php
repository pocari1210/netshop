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

  // ★プロフィール編集のコントローラー★
  public function EditProfile()
  {
    $id = Auth::user()->id;
    $editData = User::find($id);

    return view(
      'admin.admin_profile_edit',
      compact('editData')
    );
  } // End Method 

  // ★プロフィール保存のコントローラー★
  public function StoreProfile(Request $request)
  {
    $id = Auth::user()->id;
    $data = User::find($id);
    $data->name = $request->name;
    $data->email = $request->email;
    $data->username = $request->username;

    if ($request->file('profile_image')) {
      $file = $request->file('profile_image');
      $filename = date('YmdHi') . $file->getClientOriginalName();
      $file->move(public_path('upload/admin_images'), $filename);
      $data['profile_image'] = $filename;
    }
    $data->save();

    return redirect()->route('admin.profile');
  } // End Method
}
