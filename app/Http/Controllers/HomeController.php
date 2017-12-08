<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use \App\UserLike;
use \App\UserLove;
use \App\Gallery;
use \App\Category;
use \App\UserOptionA;
use \App\GalleryStyle;
use \App\SurveyAnswer1;
use \App\SurveyAnswer2;
use \App\SurveyAnswerSize;
use \App\SurveyQuestion;
use \App\QuestionComment;
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
        // $user_survey_results = UserOptionA::where('user_id', Auth:user()->id)->get()
        $comment_users = QuestionComment::join('users', 'users.id', '=', 'question_comments.user_id')->select('question_comments.*', 'users.first_name', 'users.last_name', 'users.avatar')->orderBy('question_comments.publish', 'DESC')->get();
        return view('estimate', ['quetions' => $questions, 'comments' => $comment_users]);
    }

    public function get_sizeoption_single($id)
    {
        $option_sizes = SurveyAnswerSize::where('question_id', $id)->orderBy('size', 'ASC')->get();
        return $option_sizes;
    }

    public function save_survey_optiona(Request $request)
    {
        $question_id = $request->question_id;
        $option_number = $request->option_size;
        $option_id = $request->option_id;

        $user_optiona_count = UserOptionA::where('question_id', $question_id)->where('user_id', Auth::user()->id)->count();

        if ($user_optiona_count > 0) {
            $user_optiona = UserOptionA::where('question_id', $question_id)->where('user_id', Auth::user()->id)->first();
            $user_optiona->option_id = $option_id;
            $user_optiona->number = $option_number;
            $user_optiona->save();
            return $user_optiona;
        }
        else {
            $user_optiona_new = new UserOptionA();
            $user_optiona_new->question_id = $question_id;
            $user_optiona_new->user_id = Auth::user()->id;
            $user_optiona_new->option_id = $option_id;
            $user_optiona_new->number = $option_number;
            $user_optiona_new->save();
            return $user_optiona_new;
        }
    }

    public function save_question_comment(Request $request)
    {
        $dt = new DateTime();

        $comment = new QuestionComment();
        $comment->question_id = $request->question_id;
        $comment->user_id = Auth::user()->id;
        $comment->comment = $request->comment;
        $comment->publish = $dt->format('Y-m-d H:i:s');
        $comment->save();

        $comment_user = QuestionComment::join('users', 'users.id', '=', 'question_comments.user_id')->select('question_comments.*', 'users.first_name', 'users.last_name', 'users.avatar')->find($comment->id);

        return $comment_user;
    }

    public function delete_comment($id)
    {
        $comment = QuestionComment::find($id);
        $comment->delete();
        return "success";
    }

    public function calculator($money)
    {
        $total_result_count = UserOptionA::where('user_id', Auth::user()->id)->count();
        if ($total_result_count > 0) {
            $total_results = UserOptionA::where('user_id', Auth::user()->id)
            ->join('survey_option1', 'survey_option1.id', '=', 'survey_option1_results.option_id')
            ->select('survey_option1_results.*', 'survey_option1.size')->get();
            $total_square_size = 0;
            foreach ($total_results as $total_result) {
                $number = $total_result->number;
                $size = $total_result->size;

                $current_size = $number * $size;
                $total_square_size += $current_size;
            }

            $total_money = $total_square_size * $money;

            $money_result = array('total_square' => $total_square_size, 'total_money' => $total_money);

            return $money_result;
        }

        return "error";
    }
}
