<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        $data = ['home_key'=>'home_value'];
        return view('home',compact('data'));
    }
    function contact(){
        $data = ['contact_key'=>'contact_value'];
        return view('contact',compact('data'));
    }
    function about(){
        $data = ['about_key'=>'about_value'];
        return view('about',compact('data'));
    }
}
