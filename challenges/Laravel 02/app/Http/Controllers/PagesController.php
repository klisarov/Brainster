<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'title' => 'Clean Blog',
            'subtitle' => 'A Blog Theme by Start Bootstrap'
        ]);
    }

    public function about()
    {
        return view('pages.about', [
            'title' => 'About Me',
            'subtitle' => 'This is what I do.'
        ]);
    }

    public function blog()
    {
        return view('pages.blog', [
            'title' => 'Man must explore, and this',
            'subtitle' => 'Problems look mighty small from 150 miles up',
            'posted_by' => 'Start Bootstrap',
            'posted_on' => 'August 24, 2018'
        ]);
    }

    public function contact()
    {
        return view('pages.contact', [
            'title' => 'Contact me',
            'subtitle' => 'Have questions? I have answers!'
        ]);
    }
}

?>