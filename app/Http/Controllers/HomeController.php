<?php

namespace App\Http\Controllers;

use Auth;
use \App\UserLike;
use \App\Gallery;
use \App\Category;
use \App\GalleryStyle;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function gallery_show($id)
    {
        $current_style = GalleryStyle::find($id);
        $gallery_images = Gallery::where('style_id' , $id)->get();
        return view('gallery', ['images' => $gallery_images, 'current_style' => $current_style]);
    }

    public function view_gallery() {
        $category1 = Category::orderBy('id', 'ASC')->get()->first();
        $category2 = Category::orderBy('id', 'DESC')->get()->first();
        $gallery_style1 = GalleryStyle::where('category_id' , $category1->id)->orderBy('id', 'ASC')->get();
        $gallery_style2 = GalleryStyle::where('category_id' , $category2->id)->orderBy('id', 'ASC')->get();
        return view('home' , ['category1' => $category1, 'category2' => $category2, 'gallery_style1' => $gallery_style1, 'gallery_style2' => $gallery_style2]);
    }

    public function like_images(Request $request)
    {
        $already_liked = UserLike::where('image_id', $request->imageId)->where('user_id', $request->useId)->get()->count();
        if($already_liked > 0) {
            $current_like= UserLike::where('image_id', $request->imageId)->where('user_id', $request->useId)->get()->first();
            $current_like->like_type = $request->status;
            $current_like->save();
        }
        else {
            $current_like = new UserLike();
            $current_like->image_id = $request->imageId;
            $current_like->user_id = $request->useId;
            $current_like->like_type = $request->status;
            $current_like->save();
        }
        return $current_like;
    }

    public function like_status_save($id)
    {
        $like_status = GalleryStyle::find($id);
        $allery_style_user_passed = explode(',', $like_status->style_completed_user);
        if(in_array(Auth::user()->id, $allery_style_user_passed)) {
            return redirect('home');
        }
        else {
            $like_status->style_completed_user = $like_status->style_completed_user.",".Auth::user()->id;
            $like_status->save();
            return redirect('home');
        }
    }

    public function get_img_for_stamp($id)
    {
        $data_image = Gallery::find($id);

        return $data_image;
    }
}
