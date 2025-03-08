<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Lawboss extends BaseController
{

    public function index()
    {
        return view('home/index');   
    }

    public function index2()
    {
        return view('home/index2');   
    }

    public function casestudy1()
    {
        return view('case_study/case-study_1');   
    }

    public function casestudy2()
    {
        return view('case_study/case-study_2');   
    }

    public function casestudy3()
    {
        return view('case_study/case-study_3');   
    }

    public function about_us()
    {
        return view('about/about_us');   
    }

    public function contacte()
    {
        return view('about/contact');   
    }

    public function teams()
    {
        return view('pages/team');   
    }

    public function services()
    {
        return view('pages/service');   
    }
    
    public function portfolios()
    {
        return view('pages/portfolio');   
    }
    
    public function faq()
    {
        return view('pages/faq');   
    }

    public function blog_list()
    {
        return view('blog/blog_liste');   
    }
    
    public function blog_columns()
    {
        return view('blog/blog_column');   
    }
    
    public function blog_details()
    {
        return view('blog/blog_detail');   
    }

    
    

    
    
}
