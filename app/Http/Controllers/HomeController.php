<?php

namespace App\Http\Controllers;

use Auth;
use \App\UserLike;
use \App\UserLove;
use \App\Gallery;
use \App\Category;
use \App\GalleryStyle;
use \App\SurveyAnswer1;
use \App\SurveyAnswer2;
use \App\SurveyAnswerSize;
use \App\SurveyQuestion;
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

    public function view_selection($id)
    {
        $current_style = GalleryStyle::find($id);
        $gallery_images = Gallery::where('style_id' , $id)->get();
        $like_images = UserLike::where('user_id' , Auth::user()->id)->get();
        return view('viewSelect', ['images' => $gallery_images, 'current_style' => $current_style, 'like_images' => $like_images]);
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

    public function save_all_stamps(Request $request)
    {
        $current_img_id = $request->imageId;

        foreach ($request->stamp_data as $single_stamp) {
            $stamp = new UserLove();
            $stamp->image_id = $current_img_id;
            $stamp->user_id = Auth::user()->id;
            $stamp->love_type = $single_stamp['love_type'];
            $stamp->pos_top = $single_stamp['top'];
            $stamp->pos_left = $single_stamp['left'];
            $stamp->save();
        }
        return "success";
    }

    public function get_selection_img($id)
    {
        $data_image = Gallery::find($id);

        $img_status = UserLike::where('image_id', $data_image->id)->where('user_id', Auth::user()->id)->get()->first();

        if ($img_status == null) {
            $final_img_data = array('img_name' => $data_image->gallery_img, 'like_type' => 'undefine');

            return $final_img_data;
        }

        if($img_status->like_type < 2) {
            $final_img_data = array('img_name' => $data_image->gallery_img, 'like_type' => $img_status->like_type);

            return $final_img_data;
        }
        else {
            $img_stamps = UserLove::where('image_id', $data_image->id)->where('user_id', Auth::user()->id)->get();

            $myArray = array();

            foreach ($img_stamps as $img_stamp)
            {
                $myArray[] = array('stamp_status' => $img_stamp->love_type, 'pos_top' => $img_stamp->pos_top, 'pos_left' => $img_stamp->pos_left);
            }

            $final_img_data = array('img_name' => $data_image->gallery_img, 'like_type' => $img_status->like_type, 'stamp_datas' => $myArray);

            return $final_img_data;
        }

        // return $img_status->like_type;
    }

    public function reset_user_selection($id)
    {
        // dd($id);
        if (Auth::user()->id) {
            $galleries = Gallery::where('style_id', $id)->get();
            foreach ($galleries as $gallery) {
                UserLike::where('image_id', $gallery->id)->where('user_id', Auth::user()->id)->delete();
                UserLove::where('image_id', $gallery->id)->where('user_id', Auth::user()->id)->delete();
            }
            return redirect('gallery/'.$id);
        }
    }

    public function construction()
    {
        $questions = SurveyQuestion::all();
        return view('estimate', ['quetions' => $questions]);
    }

    public function get_sizeoption_single($id)
    {
        $option_sizes = SurveyAnswerSize::where('question_id', $id)->orderBy('size', 'ASC')->get();
        return $option_sizes;
    }
}
