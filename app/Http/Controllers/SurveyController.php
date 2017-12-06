<?php

namespace App\Http\Controllers;

use \App\SurveyAnswer1;
use \App\SurveyAnswer2;
use \App\SurveyAnswerSize;
use \App\SurveyQuestion;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function view_survey()
    {
        $questions = SurveyQuestion::all();
        $optionA = SurveyAnswer1::join('survey_questions', 'survey_questions.id', '=', 'survey_option1.question_id')
        ->select('survey_option1.*', 'survey_questions.title as question_name')
        ->getQuery()
        ->get();

        $optionB = SurveyAnswer2::join('survey_questions', 'survey_questions.id', '=', 'survey_option2.question_id')
        ->select('survey_option2.*', 'survey_questions.title as question_name')
        ->getQuery()
        ->get();

        $optionB_size = SurveyAnswerSize::join('survey_questions', 'survey_questions.id', '=', 'survey_option2_size.question_id')
        ->select('survey_option2_size.*', 'survey_questions.title as question_name')
        ->getQuery()
        ->get();

        return view('admin.admin_survey_management', ['questions' => $questions, 'optionA' => $optionA, 'optionB' => $optionB, 'optionB_size' => $optionB_size]);
    }

    public function question_add(Request $request)
    {
        $question = new SurveyQuestion();
        $question->title = $request->question_title;
        $question->type = $request->question_type;
        $question->save();

        return back()->with('status', 'Added New Question');
    }

    public function question_edit(Request $request)
    {
        $question = SurveyQuestion::find($request->_question_id);
        $question->title = $request->_question_title;
        $question->type = $request->_question_type;
        $question->save();
        return back()->with('status', 'Edited Question');
    }

    public function delete_question($id)
    {
        $question = SurveyQuestion::find($id);
        if ($question->id) {

            $datas = SurveyAnswer1::where('question_id', $id)->get();
            foreach ($datas as $data) {
                $this->delete_answer($data->id);
            }
            $question->delete();
            return "success";
        }
        return "error";
    }

    public function get_single_question($id)
    {
        $question = SurveyQuestion::find($id);
        return $question;
    }

    public function add_answer(Request $request)
    {
        $result_validate = $this->validate($request, [
            'answer_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imageRand = rand(1000, 9999);
        $random_name = time()."_".$imageRand;

        $answer = new SurveyAnswer1();
        $answer->title = $request->answer_title;
        $answer->img_name = $random_name;
        $answer->size = $request->answer_size;
        $answer->question_id = $request->question_id;
        $answer->save();

        $img = $request->answer_img;

        $dst = public_path('assets/images/survey/');

        $img->move($dst, $answer->img_name.".jpg");

        $new_img = $dst.$answer->img_name.".jpg";
        // dd($new_img);
        if (($img_info = getimagesize($new_img)) === FALSE)
            return back()->with('error', 'Image not found or not an image');

        $width = $img_info[0];
        $height = $img_info[1];

        switch ($img_info[2]) {
          case IMAGETYPE_GIF  : $src = imagecreatefromgif($new_img);  break;
          case IMAGETYPE_JPEG : $src = imagecreatefromjpeg($new_img); break;
          case IMAGETYPE_PNG  : $src = imagecreatefrompng($new_img);  break;
          default : return back()->with('error', 'Unknown file type');
        }
        $thumbnail = public_path('assets/images/survey/') .$random_name.'_thumbnail';

        // $tmp = imagecreatetruecolor($width, $height);
        $tmp_thumbnail = imagecreatetruecolor(200,  200);
        // imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
        imagecopyresized($tmp_thumbnail, $src, 0, 0, 0, 0, 200, 200, $width, $height);
        // imagejpeg($tmp, $dst . ".jpg");
        imagejpeg($tmp_thumbnail, $thumbnail . ".jpg");

        return back()->with('status', 'Added new Option A');
    }

    public function get_single_answer($id)
    {
        $answer = SurveyAnswer1::find($id);
        return $answer;
    }

    public function answer_edit(Request $request)
    {
        $answer = SurveyAnswer1::find($request->_answer_id);
        if ($answer->id) {
            $answer->title = $request->_answer_title;
            $answer->size = $request->_answer_size;
            $answer->question_id = $request->_answer_question_id;
            $answer->save();

            if ($request->_answer_img) {

                $result_validate = $this->validate($request, [
                    '_answer_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);

                $dst = public_path('assets/images/survey/');

                if (file_exists($dst.$answer->img_name.'.jpg')) {
                    unlink($dst.$answer->img_name.'.jpg');
                    unlink($dst.$answer->img_name.'_thumbnail.jpg');
                }

                $imageRand = rand(1000, 9999);
                $random_name = time()."_".$imageRand;

                $answer->img_name = $random_name;
                $answer->save();

                $img = $request->_answer_img;

                $img->move($dst, $answer->img_name.".jpg");

                $new_img = $dst.$answer->img_name.".jpg";
                // dd($new_img);
                if (($img_info = getimagesize($new_img)) === FALSE)
                    return back()->with('error', 'Image not found or not an image');

                $width = $img_info[0];
                $height = $img_info[1];

                switch ($img_info[2]) {
                  case IMAGETYPE_GIF  : $src = imagecreatefromgif($new_img);  break;
                  case IMAGETYPE_JPEG : $src = imagecreatefromjpeg($new_img); break;
                  case IMAGETYPE_PNG  : $src = imagecreatefrompng($new_img);  break;
                  default : return back()->with('error', 'Unknown file type');
                }
                $thumbnail = public_path('assets/images/survey/') .$random_name.'_thumbnail';

                // $tmp = imagecreatetruecolor($width, $height);
                $tmp_thumbnail = imagecreatetruecolor(200,  200);
                // imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
                imagecopyresized($tmp_thumbnail, $src, 0, 0, 0, 0, 200, 200, $width, $height);
                // imagejpeg($tmp, $dst . ".jpg");
                imagejpeg($tmp_thumbnail, $thumbnail . ".jpg");
            }

            return back()->with('status', 'Edited Option A');
        }

        return back()->with('error', 'Answer can not find');
    }

    public function delete_answer($id)
    {
        $answer = SurveyAnswer1::find($id);
        if ($answer->id) {
            $answer->delete();
            return "success";
        }

        return "error";

    }

    public function add_optionb_other(Request $request)
    {
        $result_validate = $this->validate($request, [
            'optionb_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imageRand = rand(1000, 9999);
        $random_name = time()."_".$imageRand;

        $optionb_other = new SurveyAnswer2();
        $optionb_other->title = $request->answer_title;
        $optionb_other->img_name = $random_name;
        $optionb_other->question_id = $request->question_id;
        $optionb_other->save();

        $img = $request->optionb_img;

        $dst = public_path('assets/images/survey/');

        $img->move($dst, $optionb_other->img_name.".jpg");

        $new_img = $dst.$optionb_other->img_name.".jpg";
        // dd($new_img);
        if (($img_info = getimagesize($new_img)) === FALSE)
            return back()->with('error', 'Image not found or not an image');

        $width = $img_info[0];
        $height = $img_info[1];

        switch ($img_info[2]) {
          case IMAGETYPE_GIF  : $src = imagecreatefromgif($new_img);  break;
          case IMAGETYPE_JPEG : $src = imagecreatefromjpeg($new_img); break;
          case IMAGETYPE_PNG  : $src = imagecreatefrompng($new_img);  break;
          default : return back()->with('error', 'Unknown file type');
        }
        $thumbnail = public_path('assets/images/survey/') .$random_name.'_thumbnail';

        // $tmp = imagecreatetruecolor($width, $height);
        $tmp_thumbnail = imagecreatetruecolor(200,  200);
        // imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
        imagecopyresized($tmp_thumbnail, $src, 0, 0, 0, 0, 200, 200, $width, $height);
        // imagejpeg($tmp, $dst . ".jpg");
        imagejpeg($tmp_thumbnail, $thumbnail . ".jpg");

        return back()->with('status', 'Added new Option B');
    }

    public function get_single_optionb_other($id)
    {
        $optionb_other = SurveyAnswer2::find($id);
        return $optionb_other;
    }

    public function optionb_other_edit(Request $request)
    {
        $optionb_other = SurveyAnswer2::find($request->_optionb_other_id);
        if ($optionb_other->id) {
            $optionb_other->title = $request->_answer_title;
            $optionb_other->question_id = $request->_optionb_other_question_id;
            $optionb_other->save();

            if ($request->_optionb_img) {

                $result_validate = $this->validate($request, [
                    '_optionb_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);

                $dst = public_path('assets/images/survey/');

                if (file_exists($dst.$optionb_other->img_name.'.jpg')) {
                    unlink($dst.$optionb_other->img_name.'.jpg');
                    unlink($dst.$optionb_other->img_name.'_thumbnail.jpg');
                }

                $imageRand = rand(1000, 9999);
                $random_name = time()."_".$imageRand;

                $optionb_other->img_name = $random_name;
                $optionb_other->save();

                $img = $request->_optionb_img;

                $img->move($dst, $optionb_other->img_name.".jpg");

                $new_img = $dst.$optionb_other->img_name.".jpg";
                // dd($new_img);
                if (($img_info = getimagesize($new_img)) === FALSE)
                    return back()->with('error', 'Image not found or not an image');

                $width = $img_info[0];
                $height = $img_info[1];

                switch ($img_info[2]) {
                  case IMAGETYPE_GIF  : $src = imagecreatefromgif($new_img);  break;
                  case IMAGETYPE_JPEG : $src = imagecreatefromjpeg($new_img); break;
                  case IMAGETYPE_PNG  : $src = imagecreatefrompng($new_img);  break;
                  default : return back()->with('error', 'Unknown file type');
                }
                $thumbnail = public_path('assets/images/survey/') .$random_name.'_thumbnail';

                // $tmp = imagecreatetruecolor($width, $height);
                $tmp_thumbnail = imagecreatetruecolor(200,  200);
                // imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
                imagecopyresized($tmp_thumbnail, $src, 0, 0, 0, 0, 200, 200, $width, $height);
                // imagejpeg($tmp, $dst . ".jpg");
                imagejpeg($tmp_thumbnail, $thumbnail . ".jpg");
            }

            return back()->with('status', 'Edited Option B Other');
        }

        return back()->with('error', 'Answer can not find');
    }

    public function delete_optionb_other($id)
    {
        $optionb_other = SurveyAnswer2::find($id);
        if ($optionb_other->id) {
            $optionb_other->delete();
            return "success";
        }

        return "error";

    }

    public function add_optionb_size(Request $request)
    {
        $optionb_size = new SurveyAnswerSize();
        $optionb_size->title = $request->size_option_title;
        $optionb_size->size = $request->size_option_size;
        $optionb_size->question_id = $request->optionb_size_question_id;
        $optionb_size->save();

        return back()->with('status', 'Added New Option B Size');
    }

    public function get_single_optionb_size($id)
    {
        $optionb_size = SurveyAnswerSize::find($id);
        return $optionb_size;
    }

    public function optionb_size_edit(Request $request)
    {
        $optionb_size = SurveyAnswerSize::find($request->current_optionsize_id);
        if ($optionb_size->id) {

            $optionb_size->title = $request->_size_option_title;
            $optionb_size->size = $request->_size_option_size;
            $optionb_size->question_id = $request->_optionb_size_question_id;
            $optionb_size->save();

            return back()->with('status', 'Updated Option B Size');
        }
    }

    public function delete_optionb_size($id)
    {
        $optionb_size = SurveyAnswerSize::find($id);
        if ($optionb_size->id) {
            $optionb_size->delete();
            return "success";
        }

        return "error";

    }
}
