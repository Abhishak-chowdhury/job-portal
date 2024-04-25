<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Auth;
class authenticationcontroller extends Controller
{
    public function Register(){
        return view("frontpages.Register");
    }
    public function Register_process(Request $request){
        $validated=$request->validate([
            'name' => 'required',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|min:8',
            'confirm-password'=>'required|same:password'
        ]);

        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        return redirect()->route('login')->with('success','Sucessfully registered...');

    }
    public function Login(){
        return view("frontpages.Login-page");
    }
    public function Login_process(Request $request){
        $validated=$request->validate([
            'email'=> 'required|email|exists:users,email',
            'password'=> 'required'
        ]);
        $crediantials=$request->only(['email','password']);
        if(Auth::attempt($crediantials)){
            return redirect()->route('profile')->with('success','sucessfully loggedin.....');
        }else{
            return redirect()->route('login')->with('warning','login crediantial are invalid.....');
        }
    }
    public function Logout_process(){
        Auth::logout();
        return redirect()->route('login')->with('success','thanks for spending time');
    }
    public function profile(){
        $user_id=Auth::user()->id;
        $user=User::find($user_id);
        $data=compact('user');
        return view('frontpages.profile',$data);
    }
    public function update_profile(Request $request){
        $validated=$request->validate([
            'email'=> 'required',
            'name'=> 'required',
            'designation'=>'required',
            'mobile'=>'required|int|digits:10'
        ]);
        $u=Auth::user()->id;
        $user=User::find($u);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->designation=$request->designation;
        $user->mobile=$request->mobile;
        $user->save();
        return back()->with('success','sucessfully updated..');
    }
    public function Upload_image(Request $request){
        $validated=$request->validate([
            'image'=> 'required|mimes:jpg,png',
        ]);
        $u_id=Auth::user()->id;
        $user=User::find($u_id);
        $find_img=public_path('user_profile').'/'.$user->image;
        if (file_exists($find_img)) {

            unlink($find_img);
     
        }
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('user_profile'), $imageName);
        $user->image = $imageName;
        $user->save();
        return back();
        
    }
    public function change_password(Request $request){
        $validated=$request->validate([
            'old_password' => 'required',
            'new_password'=> 'required|min:8',
            'confirm_password'=> 'required|same:new_password',
            
        ]);
        if(Hash::check($request->old_password, Auth::user()->password)){
            $user=User::where('id',Auth::user()->id)->first();
            $user->password=Hash::make($request->new_password);
            $user->save();
            return redirect()->route('profile')->with('success','sucessfully updated');
        }else{
            return redirect()->route('profile')->with('warning','old password wrong');
        }
    }
}
