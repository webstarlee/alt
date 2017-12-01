<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view_profile() {
        return view('profile');
    }

    public function change_basic(Request $request) {
        if(Auth::check()) {
            $user = Auth::user();
            $old_user_name = $user->first_name.$user->last_name;
            $new_user_name = $request->first_name.$request->last_name;
            if ($old_user_name != $new_user_name) {
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->save();
                return back()->with('status', 'Name changed succesfully');
            }
            else {
                return back()->with('error', 'You already have this name');
            }
        }
        return back()->with('error', 'Permission denied');
    }

    public function change_email(Request $request) {

        if (Auth::check()) {

            $obj_user = Auth::user();
            if($obj_user->email == $request->input('email'))
            {
                return back()->with('error', 'You have already this email address.');
            } else if($this->isExistEmail($request->input('email')) == true)
            {
                return back()->with('error', 'This email address has already been taken.');
            }
            else {
                $obj_user->email = $request->input('email');
                $obj_user->save();
                return back()->with('status','Email changed successfully.');
            }
        } else {
            return back()->with('error', 'You have no access for this action');
        }
    }

    public function change_avatar(Request $request) {

        if (Auth::check()) {
            $this->validate($request, [
                'user_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $imageRand = rand(1000, 9999);

            $user = Auth::user();
            $user->avatar = $user->id."_".$imageRand;
            $user->save();

            $img = $request->user_image;


            $dst = public_path('assets/images/avatar/') . $user->avatar;
            $thumbnail = public_path('assets/images/avatar/') . $user->avatar.'_thumbnail';
            if (($img_info = getimagesize($img)) === FALSE)
                return back()->with('error', 'Image not found or not an image')->with('tap', 'avartar');

            $width = $img_info[0];
            $height = $img_info[1];

            switch ($img_info[2]) {
              case IMAGETYPE_GIF  : $src = imagecreatefromgif($img);  break;
              case IMAGETYPE_JPEG : $src = imagecreatefromjpeg($img); break;
              case IMAGETYPE_PNG  : $src = imagecreatefrompng($img);  break;
              default : return back()->with('error', 'Unknown file type');
            }

            $tmp = imagecreatetruecolor($width, $height);
            $tmp_thumbnail = imagecreatetruecolor(500,  500);
            imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
            imagecopyresized($tmp_thumbnail, $src, 0, 0, 0, 0, 500, 500, $width, $height);
            imagejpeg($tmp, $dst . ".jpg");
            imagejpeg($tmp_thumbnail, $thumbnail . ".jpg");
            // $imageName = time().'.'.$request->image->getClientOriginalExtension();
            // $request->image->move(public_path('images/avatar'), $imageName);

            return back()->with('status', 'Your Photo changed successfully');
        } else {
            return back()->with('error', 'You have no access for this action');
        }
    }

    public function change_password(Request $request) {
        if (Auth::check()) {
            $requestData = $request->All();

            $current_password = Auth::user()->password;
            if (Hash::Check($requestData['current_password'], $current_password)) {
                $obj_user = Auth::user();
                $obj_user->password = bcrypt($requestData['password']);
                $obj_user->save();
                return back()->with('status', 'Password changed successfully');
            } else {
                return back()->with('error', 'Please enter correct current password');
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function isExistEmail($email){
        $user = User::where(array('email' => $email))->count();
        if($user != 0){
            return true;
        }else{
            return false;
        }
    }
}
