<?php

namespace App\Http\Controllers;
use App\Models\Static_pages;
use Illuminate\Support\Facades\DB;



use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    // Je predpokladana jen jedna staticka "about" stranka s id = 1

    public function index()
    {
        $about_page = DB::table('static_pages')->where('id','=',1)->first();
        return view('home.about',['page' => $about_page->content]);
    }

    //formular pro edit
    public function edit()
    {
        $about_page = DB::table('static_pages')->where('id','=',1)->first();
        return view('admin.static.edit_about',['page' => $about_page]);
    }

    public function update(Request $request)
    {
        $about_page = Static_pages::find((1));

        $this->validate($request,[
            'content'=>'required',
        ]);

        $about_page->content = $request -> content;
        $about_page -> save();

        return redirect()->route('dashboard');
    }
}
