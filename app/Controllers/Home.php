<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('bookings');
    }

    public function contactPage()
    {
        return view('contact');
    }

    public function contactLink()
    {
        return redirect()->to('https://wa.me/6285748454365');
    }
}
