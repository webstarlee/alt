<?php

namespace App\Http\Controllers;

use \App\Gallery;
use \App\Category;
use \App\GalleryStyle;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:admin');
    }

    public function gallery_view()
    {
        $category = Category::all();
        $gallery_style = GalleryStyle::join('categories', 'categories.id', '=', 'gallery_styles.category_id')
        ->select('gallery_styles.*', 'categories.category_name')
        ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
        ->get();
        return view('admin.admin_gallery_management' , ['categories' => $category, 'gallery_styles' => $gallery_style]);
    }

    public function gallery_view_single($id) {
        $current_style = GalleryStyle::find($id);
        $gallery_images = Gallery::where('style_id' , $id)->get();
        return view('admin.admin_gallery_single', ['images' => $gallery_images, 'current_style' => $current_style]);
    }

    public function get_single_category($id) {
        $single_category = Category::find($id);
        return Response()->json($single_category);
    }

    public function get_single_style($id) {
        $single_style = GalleryStyle::find($id);
        return Response()->json($single_style);
    }

    public function store_category(Request $request)
    {
        $category_count = Category::get()->count();
        if($category_count < 2)
        {
            $result_validate = $this->validate($request, [
                'category_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $imageRand = rand(1000, 9999);
            $random_name = time()."_".$imageRand;

            $category = new Category();
            $category->category_name = $request->category_name;
            $category->category_img = $random_name;
            $category->save();

            $img = $request->category_img;

            $dst = public_path('assets/images/gallery/category/');

            $img->move($dst, $category->category_img.".jpg");

            $new_img = $dst.$category->category_img.".jpg";
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
            $thumbnail = public_path('assets/images/gallery/category/') .$random_name.'_thumbnail';

            // $tmp = imagecreatetruecolor($width, $height);
            $tmp_thumbnail = imagecreatetruecolor(200,  200);
            // imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
            imagecopyresized($tmp_thumbnail, $src, 0, 0, 0, 0, 200, 200, $width, $height);
            // imagejpeg($tmp, $dst . ".jpg");
            imagejpeg($tmp_thumbnail, $thumbnail . ".jpg");

            return back()->with('status', 'Added new Category');
        }

        return back()->with('error', 'Just Category count limited for 2');
    }

    public function update_category(Request $request)
    {

        $category = Category::find($request->category_id);
        if ($category->id) {
            $category->category_name = $request->_category_name;
            $category->save();

            if($request->_category_img) {

                $result_validate = $this->validate($request, [
                    '_category_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);

                $dst = public_path('assets/images/gallery/category/');

                if (file_exists($dst.$category->category_img.'.jpg')) {
                    unlink($dst.$category->category_img.'.jpg');
                    unlink($dst.$category->category_img.'_thumbnail.jpg');
                }

                $imageRand = rand(1000, 9999);
                $random_name = time()."_".$imageRand;

                $category->category_img = $random_name;
                $category->save();

                $img = $request->_category_img;

                $img->move($dst, $category->category_img.".jpg");

                $new_img = $dst.$category->category_img.".jpg";
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
                $thumbnail = public_path('assets/images/gallery/category/') .$random_name.'_thumbnail';

                // $tmp = imagecreatetruecolor($width, $height);
                $tmp_thumbnail = imagecreatetruecolor(200,  200);
                // imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
                imagecopyresized($tmp_thumbnail, $src, 0, 0, 0, 0, 200, 200, $width, $height);
                // imagejpeg($tmp, $dst . ".jpg");
                imagejpeg($tmp_thumbnail, $thumbnail . ".jpg");
            }
            return back()->with('status', 'Added new Category');
        }
    }

    public function store_style(Request $request)
    {
        $result_validate = $this->validate($request, [
            'style_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imageRand = rand(1000, 9999);
        $random_name = time()."_".$imageRand;

        $style = new GalleryStyle();
        $style->style_title = $request->style_title;
        $style->style_name = $request->style_name;
        $style->style_img = $random_name;
        $style->style_completed_user = 'start';
        $style->category_id = $request->style_category;
        $style->save();

        $img = $request->style_img;

        $dst = public_path('assets/images/gallery/style/');

        $img->move($dst, $style->style_img.".jpg");

        $new_img = $dst.$style->style_img.".jpg";
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
        $thumbnail = public_path('assets/images/gallery/style/') .$random_name.'_thumbnail';

        // $tmp = imagecreatetruecolor($width, $height);
        $tmp_thumbnail = imagecreatetruecolor(200,  200);
        // imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
        imagecopyresized($tmp_thumbnail, $src, 0, 0, 0, 0, 200, 200, $width, $height);
        // imagejpeg($tmp, $dst . ".jpg");
        imagejpeg($tmp_thumbnail, $thumbnail . ".jpg");

        return back()->with('status', 'Added new Gallery Style');
    }

    public function update_style(Request $request)
    {

        $style = GalleryStyle::find($request->style_id);
        if($style->id) {
            $style->style_title = $request->_style_title;
            $style->style_name = $request->_style_name;
            $style->category_id = $request->_style_category;
            $style->save();

            if($request->_style_img) {

                $dst = public_path('assets/images/gallery/style/');

                $result_validate = $this->validate($request, [
                    '_style_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);

                if (file_exists($dst.$style->style_img.'.jpg')) {
                    unlink($dst.$style->style_img.'.jpg');
                    unlink($dst.$style->style_img.'_thumbnail.jpg');
                }

                $imageRand = rand(1000, 9999);
                $random_name = time()."_".$imageRand;

                $style->style_img = $random_name;
                $style->save();

                $img = $request->_style_img;

                $img->move($dst, $style->style_img.".jpg");

                $new_img = $dst.$style->style_img.".jpg";
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
                $thumbnail = public_path('assets/images/gallery/style/') .$random_name.'_thumbnail';

                // $tmp = imagecreatetruecolor($width, $height);
                $tmp_thumbnail = imagecreatetruecolor(200,  200);
                // imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
                imagecopyresized($tmp_thumbnail, $src, 0, 0, 0, 0, 200, 200, $width, $height);
                // imagejpeg($tmp, $dst . ".jpg");
                imagejpeg($tmp_thumbnail, $thumbnail . ".jpg");
            }
            return back()->with('status', 'Added new Gallery Style');
        }
    }

    public function gallery_upload_images(Request $request) {


        if($request->hasFile('files'))
        {
            $style_id = $request->style_id;
            $files = $request->file('files');
            $result_img = array();
            foreach ($files as $file) {
                // dd($file);
                $imageRand = rand(1000, 9999);
                $random_name = time()."_".$imageRand;

                $gallery = new Gallery();
                $gallery->style_id = $style_id;
                $gallery->gallery_img = $random_name;
                $gallery->save();

                $img = $file;

                $dst = public_path('assets/images/gallery/');

                $img->move($dst, $gallery->gallery_img.".jpg");

                $new_img = $dst.$gallery->gallery_img.".jpg";
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
                $thumbnail = public_path('assets/images/gallery/') .$random_name.'_thumbnail';

                // $tmp = imagecreatetruecolor($width, $height);
                $tmp_thumbnail = imagecreatetruecolor(500,  500);
                // imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
                imagecopyresized($tmp_thumbnail, $src, 0, 0, 0, 0, 500, 500, $width, $height);
                // imagejpeg($tmp, $dst . ".jpg");
                imagejpeg($tmp_thumbnail, $thumbnail . ".jpg");

                $display_thumurl = 'assets/images/gallery/'.$random_name.'_thumbnail.jpg';
                $result_img[] = array('thumbnailUrl' => $display_thumurl, 'name' => $random_name.'.jpg',);

            }
            return response()->json(array('files' => $result_img), 200);
        }
    }

}
