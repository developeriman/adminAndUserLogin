<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminLoginRequest;

class AdminController extends Controller
{
   public function adminLoginForm()
   {
      return view('admin.login');
   }

   public function adminLogin(AdminLoginRequest $request)
   {
      if (Auth::guard("admin")->attempt(["email" => $request["email"],"password" => $request["password"]])) {
         return redirect("admin/dashboard");
      } else {
         return redirect()->back()->with("error_message", "Invalid Email or Password");
      }
   }

   public function adminLogout(){
      Auth::guard('admin')->logout();
      return redirect('admin/login');
   }
}
