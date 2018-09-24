<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){

        $title = "Welcome to Welcome to Sub Tec Community";
        return view('pages.index')->with('title', $title);
    }

    public function about(){

        $title = "About Us";
        return view('pages.about')->with('title', $title);
    }

    public function services(){

        $info = array(
            "title" => "Our Services",
            "services" => ['Web Design', 'Programming', 'App Development', 'SEO']
        );
        
        return view('pages.services')->with($info);
    }
}
