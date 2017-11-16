<?php

namespace App\Http\Controllers;

use Auth;
use \App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
   {
       $this->middleware('auth:admin');
   }

   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       return view('admin.admin_home');
   }

   public function admin_profile()
   {
      return view('admin.admin_profile');
    }

    public function change_admin_name(Request $request)
    {
        if(Auth::guard('admin')->user()->id){
            $obj_admin = Auth::guard('admin')->user();
            if($request->input('name') != $obj_admin->name)
            {
                $obj_admin->name = $request->input('name');
                $obj_admin->save();
                return back()->with('status', 'Name changed successfully');
            }
            return back()->with('error', 'You have already this User Name.');
        }
        return back()->with('error', 'Went somthing wrong');
    }

    public function change_email(Request $request)
    {
        if (Auth::guard('admin')->user()->id) {
            $obj_admin = Auth::guard('admin')->user();

            //if Verified email
            if($obj_admin->email == $request->input('email'))
            {
                return back()->with('error', 'You have already this email address.');
            }
            //if Email already exist
            if($this->isExistEmail($request->input('email')) == true)
            {
                return back()->with('error', 'This email address has already been taken.');
            }

            $obj_admin->email = $request->input('email');
            $obj_admin->save();
            if($obj_admin->email == $request->input('email')){
              return back()->with('status','Email changed successfully.');
            }else
                return back()->with('error', 'Something went wrong in email updating.');
        } else {
            return back()->with('error', 'You have no access for this action');
        }
    }

    public function isExistEmail($email){
        $user = DB::table('admins')->where(array('email' => $email))->count();
        if($user != 0){
            return true;
        }else{
            return false;
        }
    }

    public function change_avatar(Request $request)
    {
        if (Auth::guard('admin')->user()->id) {
            $this->validate($request, [
                'user_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $imageRand = rand(1000, 9999);
            $admin = Auth::guard('admin')->user();
            $admin->avatar = Auth::guard('admin')->user()->id."_".$imageRand;
            $admin->save();

            $img = $request->user_image;


            $dst = public_path('assets/images/avatar/admin/') . Auth::guard('admin')->user()->avatar;
            $thumbnail = public_path('assets/images/avatar/admin/') . Auth::guard('admin')->user()->avatar.'_thumbnail';
            if (($img_info = getimagesize($img)) === FALSE)
                return back()->with('error', 'Image not found or not an image');

            $width = $img_info[0];
            $height = $img_info[1];

            switch ($img_info[2]) {
              case IMAGETYPE_GIF  : $src = imagecreatefromgif($img);  break;
              case IMAGETYPE_JPEG : $src = imagecreatefromjpeg($img); break;
              case IMAGETYPE_PNG  : $src = imagecreatefrompng($img);  break;
              default : return back()->with('error', 'Unknown file type');
            }

            $tmp = imagecreatetruecolor($width, $height);
            $tmp_thumbnail = imagecreatetruecolor(200,  200);
            imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
            imagecopyresized($tmp_thumbnail, $src, 0, 0, 0, 0, 200, 200, $width, $height);
            imagejpeg($tmp, $dst . ".jpg");
            imagejpeg($tmp_thumbnail, $thumbnail . ".jpg");
            // $imageName = time().'.'.$request->image->getClientOriginalExtension();
            // $request->image->move(public_path('images/avatar'), $imageName);

            return back()->with('status', 'Your avatar changed successfully');
        } else {
            return back()->with('error', 'You have no access for this action');
        }
    }

    public function change_password(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            $requestData = $request->All();
            $this->validateChangePassword($requestData);
            $current_password = Auth::guard('admin')->user()->password;
            if (Hash::Check($requestData['current-password'], $current_password)) {
                $obj_admin = Auth::guard('admin')->user();
                $obj_admin->password = bcrypt($requestData['password']);
                $obj_admin->save();
                return back()->with('status', 'Password changed successfully');
            } else {
                return back()->with('error', 'Please enter correct current password');
            }
        } else {
            return redirect()->to('/');
        }
    }

    private function validateChangePassword(array $data)
    {
        $messages = [
            'current-password.required' => 'Please enter current password',
            'password.required' => 'Please enter password',
            'password.regex' => 'Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters'
        ];

        $validator = Validator::make($data, [
            'current-password' => 'required',
        ], $messages);

        return $validator->validate();
    }

    public function admin_pages()
    {
      return view('admin.admin_page');
    }

    public function user_management()
    {
        $users = DB::table('users')->get();
        return view('admin.admin_user_management',['users' => $users]);
    }

    public function delete_user(Request $request)
    {
      $user_id = $request->user_id;
      DB::table('users')->where('id', '=', $user_id)->delete();
    }

    public function film_management()
    {
        $films = DB::table('videos')->get();
        return view('admin.admin_film_management',['films' => $films]);
    }

    public function add_film(Request $request)
    {
        $data = $request->all();
        $film_url = "https://www.youtube.com/embed/".$data['url'];
        $films = DB::table('videos')->insert(['film_name' => $data['name'], 'film_type' => $data['ftype'], 'film_url' => $film_url, 'film_url_dev' => $data['url'], 'arrive_at' => 'now']);

        return back()->with('status', 'Have been created new Admin');
    }

    public function delete_film(Request $request)
    {
      $film_id = $request->film_id;
      DB::table('videos')->where('id', '=', $film_id)->delete();
    }

    public function edit_film(Request $request)
    {
      $film_id = $request->film_id;
      $film_name = $request->name;
      $film_url_dev = $request->url;
      $film_url = "https://www.youtube.com/embed/".$request->url;
      $film_type = $request->ftype;
      DB::table('videos')->where('id', $film_id)->update(['film_name' => $film_name, 'film_type' => $film_type, 'film_url' => $film_url, 'film_url_dev' => $film_url_dev, 'arrive_at' => 'now']);
      return back()->with('status', 'Have been updated new Admin');
    }
}
