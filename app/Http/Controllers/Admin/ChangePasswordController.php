<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index(){
        $title = "Đổi mật khẩu";
        return view('backend.change-password',compact('title'));
    }

    public function update(Request $request){
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        if(password_verify($request->old_password,auth()->user()->password)){
            auth()->user()->update([
                'password' => Hash::make($request->password)
            ]);
            return back()->with('success',"Đã đổi mật khẩu thành công.");
        }else{
            return back()->with('danger',"Mật khẩu cũ không đúng!!!");
        }
    }
}
