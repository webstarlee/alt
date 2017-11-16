<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function get_page_info()
    {
        $servicedata = DB::table('site_terms')->where('id', 1)->get();
        return $servicedata;
    }

    public function update_terms(Request $request)
    {
        DB::table('site_terms')->where('id', 1)->update(['terms_use' => $request->terms]);
        return 'successfully';
    }

    public function update_privacy(Request $request)
    {
        DB::table('site_terms')->where('id', 1)->update(['privacy_policy' => $request->privacy]);
        return 'successfully';
    }


    public function update_aboutus(Request $request)
    {
        DB::table('site_terms')->where('id', 1)->update(['about_us' => $request->aboutus]);
        return 'successfully';
    }
    public function update_howitwork(Request $request)
    {
        DB::table('site_terms')->where('id', 1)->update(['how_it_work' => $request->howitwork]);
        return 'successfully';
    }
    public function termsCondition()
    {
        $allservicedata = DB::table('site_terms')->where('id', 1)->get();
        return view('auth.termsCondition',['pagedata' => $allservicedata[0]]);
    }

    public function about_us()
    {
        $allservicedata = DB::table('site_terms')->where('id', 1)->get();
        return view('auth.aboutUs',['pagedata' => $allservicedata[0]]);
    }

    public function privacy_policy()
    {
        $allservicedata = DB::table('site_terms')->where('id', 1)->get();
        return view('auth.privacyPolicy',['pagedata' => $allservicedata[0]]);
    }

    public function how_it_work()
    {
        $allservicedata = DB::table('site_service')->where('id', 1)->get();
        return view('auth.howItWork',['pagedata' => $allservicedata[0]]);
    }
}
